<?php
namespace MuseeVirtuel\Core;

class View {
    public function render(string $viewPath, array $data = []) {
        extract($data);
        require __DIR__ . '/../../views/' . $viewPath . '.php';
    }
}