class ThreeDPreview {
    constructor(containerId, options = {}) {
        this.container = document.getElementById(containerId);
        if (!this.container) return;

        // Default options
        this.options = {
            modelPath: '', // Path to 3D model
            backgroundColor: 0xf0f0f0,
            cameraPosition: { x: 0, y: 0, z: 5 },
            enableZoom: true,
            enablePan: true,
            enableRotate: true,
            autoRotate: true,
            autoRotateSpeed: 1,
            showControls: true,
            loadingColor: 0xcccccc,
            ...options
        };

        // Initialize Three.js components
        this.initScene();
        this.initRenderer();
        this.initCamera();
        this.initLights();
        this.initControls();

        // Load model
        if (this.options.modelPath) {
            this.loadModel(this.options.modelPath);
        }

        // Handle window resize
        window.addEventListener('resize', this.onWindowResize.bind(this));
        this.onWindowResize();

        // Start animation loop
        this.animate();
    }

    initScene() {
        this.scene = new THREE.Scene();
        this.scene.background = new THREE.Color(this.options.backgroundColor);
        
        // Add grid helper
        const gridHelper = new THREE.GridHelper(10, 10);
        this.scene.add(gridHelper);
        
        // Add axis helper
        const axesHelper = new THREE.AxesHelper(5);
        this.scene.add(axesHelper);
    }

    initRenderer() {
        this.renderer = new THREE.WebGLRenderer({ antialias: true });
        this.renderer.setPixelRatio(window.devicePixelRatio);
        this.renderer.setSize(this.container.clientWidth, this.container.clientHeight);
        this.renderer.outputEncoding = THREE.sRGBEncoding;
        this.container.appendChild(this.renderer.domElement);
    }

    initCamera() {
        this.camera = new THREE.PerspectiveCamera(
            45, 
            this.container.clientWidth / this.container.clientHeight, 
            0.1, 
            1000
        );
        this.camera.position.set(
            this.options.cameraPosition.x,
            this.options.cameraPosition.y,
            this.options.cameraPosition.z
        );
    }

    initLights() {
        // Ambient light
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
        this.scene.add(ambientLight);
        
        // Directional light
        const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
        directionalLight.position.set(1, 1, 1);
        this.scene.add(directionalLight);
        
        // Hemisphere light
        const hemisphereLight = new THREE.HemisphereLight(0xffffff, 0x444444, 0.6);
        hemisphereLight.position.set(0, 1, 0);
        this.scene.add(hemisphereLight);
    }

    initControls() {
        if (this.options.showControls) {
            this.controls = new THREE.OrbitControls(this.camera, this.renderer.domElement);
            this.controls.enableZoom = this.options.enableZoom;
            this.controls.enablePan = this.options.enablePan;
            this.controls.enableRotate = this.options.enableRotate;
            this.controls.autoRotate = this.options.autoRotate;
            this.controls.autoRotateSpeed = this.options.autoRotateSpeed;
        }
    }

    loadModel(modelPath) {
        // Show loading state
        this.showLoading();
        
        const loader = new THREE.GLTFLoader();
        loader.load(
            modelPath,
            (gltf) => {
                this.model = gltf.scene;
                this.scene.add(this.model);
                
                // Center model
                this.centerModel();
                
                // Hide loading
                this.hideLoading();
            },
            (xhr) => {
                // Progress callback
                const percentComplete = (xhr.loaded / xhr.total) * 100;
                console.log(`${percentComplete.toFixed(2)}% loaded`);
            },
            (error) => {
                console.error('Error loading model:', error);
                this.hideLoading();
                this.showError();
            }
        );
    }

    centerModel() {
        if (!this.model) return;
        
        const box = new THREE.Box3().setFromObject(this.model);
        const center = box.getCenter(new THREE.Vector3());
        const size = box.getSize(new THREE.Vector3());
        
        // Center model
        this.model.position.x += (this.model.position.x - center.x);
        this.model.position.y += (this.model.position.y - center.y);
        this.model.position.z += (this.model.position.z - center.z);
        
        // Adjust camera to fit model
        const maxDim = Math.max(size.x, size.y, size.z);
        const fov = this.camera.fov * (Math.PI / 180);
        let cameraZ = Math.abs(maxDim / 2 * Math.tan(fov * 2));
        
        // Add some padding
        cameraZ *= 1.5;
        this.camera.position.z = cameraZ;
        
        if (this.controls) {
            this.controls.update();
        }
    }

    showLoading() {
        this.loadingIndicator = document.createElement('div');
        this.loadingIndicator.className = '3d-preview-loading';
        this.loadingIndicator.innerHTML = `
            <div class="loading-spinner"></div>
            <div class="loading-text">Loading 3D Model...</div>
        `;
        this.container.appendChild(this.loadingIndicator);
    }

    hideLoading() {
        if (this.loadingIndicator) {
            this.container.removeChild(this.loadingIndicator);
            this.loadingIndicator = null;
        }
    }

    showError() {
        const errorElement = document.createElement('div');
        errorElement.className = '3d-preview-error';
        errorElement.innerHTML = `
            <div class="error-icon">!</div>
            <div class="error-text">Failed to load 3D model</div>
            <button class="retry-btn">Retry</button>
        `;
        
        errorElement.querySelector('.retry-btn').addEventListener('click', () => {
            this.container.removeChild(errorElement);
            this.loadModel(this.options.modelPath);
        });
        
        this.container.appendChild(errorElement);
    }

    onWindowResize() {
        this.camera.aspect = this.container.clientWidth / this.container.clientHeight;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(this.container.clientWidth, this.container.clientHeight);
    }

    animate() {
        requestAnimationFrame(this.animate.bind(this));
        
        if (this.controls) {
            this.controls.update();
        }
        
        this.renderer.render(this.scene, this.camera);
    }

    dispose() {
        window.removeEventListener('resize', this.onWindowResize);
        
        if (this.controls) {
            this.controls.dispose();
        }
        
        if (this.model) {
            this.scene.remove(this.model);
            // Dispose of model geometry and materials
            this.model.traverse((child) => {
                if (child.isMesh) {
                    child.geometry.dispose();
                    if (child.material) {
                        if (Array.isArray(child.material)) {
                            child.material.forEach(material => material.dispose());
                        } else {
                            child.material.dispose();
                        }
                    }
                }
            });
        }
        
        if (this.renderer) {
            this.renderer.dispose();
        }
        
        this.container.innerHTML = '';
    }
}

// CSS for 3D preview component
const style = document.createElement('style');
style.textContent = `
.3d-preview-loading {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: rgba(240, 240, 240, 0.8);
    z-index: 10;
}

.loading-spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 1rem;
}

.loading-text {
    font-size: 1.2rem;
    color: #333;
}

.3d-preview-error {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: rgba(240, 240, 240, 0.8);
    z-index: 10;
}

.error-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: #e74c3c;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.error-text {
    font-size: 1.2rem;
    color: #333;
    margin-bottom: 1.5rem;
}

.retry-btn {
    padding: 0.5rem 1.5rem;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s;
}

.retry-btn:hover {
    background-color: #2980b9;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
`;
document.head.appendChild(style);

// Initialize 3D preview when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const virtualTourPreview = new ThreeDPreview('virtualTourContainer', {
        modelPath: 'models/exhibition-room.glb',
        backgroundColor: 0xeeeeee,
        autoRotate: true,
        autoRotateSpeed: 0.5,
        cameraPosition: { x: 0, y: 2, z: 10 }
    });
});