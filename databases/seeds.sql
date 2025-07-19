-- Seed SQL pour la base de données du musée d'art

-- Artistes
INSERT INTO artists (name, slug, biography, birth_date, death_date, is_featured, period, portrait, rating) VALUES
('Vincent van Gogh', 'vincent-van-gogh', 'Peintre post-impressionniste néerlandais connu pour son usage expressif de la couleur et son style unique.', '1853-03-30', '1890-07-29', TRUE, 'Post-impressionnisme', 'van-gogh-portrait.jpg', 5),
('Pablo Picasso', 'pablo-picasso', 'Artiste espagnol prolifique, co-fondateur du mouvement cubiste.', '1881-10-25', '1973-04-08', TRUE, 'Cubisme', 'picasso-portrait.jpg', 5),
('Claude Monet', 'claude-monet', 'Peintre français et figure centrale du mouvement impressionniste.', '1840-11-14', '1926-12-05', TRUE, 'Impressionnisme', 'monet-portrait.jpg', 4),
('Frida Kahlo', 'frida-kahlo', 'Artiste mexicaine connue pour ses autoportraits et son style vibrant.', '1907-07-06', '1954-07-13', TRUE, 'Surréalisme', 'kahlo-portrait.jpg', 4),
('Leonardo da Vinci', 'leonardo-da-vinci', 'Génie de la Renaissance italienne, peintre de la Joconde.', '1452-04-15', '1519-05-02', TRUE, 'Renaissance', 'davinci-portrait.jpg', 5),
('Georgia O\'Keeffe', 'georgia-okeeffe', 'Artiste américaine connue pour ses peintures de fleurs et du sud-ouest américain.', '1887-11-15', '1986-03-06', FALSE, 'Modernisme', 'okeeffe-portrait.jpg', 3),
('Salvador Dalí', 'salvador-dali', 'Artiste surréaliste espagnol connu pour ses images oniriques.', '1904-05-11', '1989-01-23', TRUE, 'Surréalisme', 'dali-portrait.jpg', 4),
('Michel-Ange', 'michel-ange', 'Sculpteur, peintre et architecte de la Haute Renaissance.', '1475-03-06', '1564-02-18', TRUE, 'Renaissance', 'michelange-portrait.jpg', 5),
('Rembrandt', 'rembrandt', 'Peintre et graveur néerlandais, maître du clair-obscur.', '1606-07-15', '1669-10-04', TRUE, 'Âge d\'or néerlandais', 'rembrandt-portrait.jpg', 5),
('Jackson Pollock', 'jackson-pollock', 'Peintre américain, figure majeure de l\'expressionnisme abstrait.', '1912-01-28', '1956-08-11', FALSE, 'Expressionnisme abstrait', 'pollock-portrait.jpg', 3);

-- Œuvres d'art
INSERT INTO artworks (title, artist_id, year, description, image, medium, category, dimensions, period, is_featured) VALUES
('La Nuit étoilée', 1, '1889', 'Une des œuvres les plus célèbres de Van Gogh, peinte depuis la fenêtre de sa chambre à l\'asile.', 'nuit-etoilee.jpg', 'Huile sur toile', 'Peinture', '73.7 × 92.1 cm', 'Post-impressionnisme', TRUE),
('Les Tournesols', 1, '1888', 'Série de tableaux représentant des tournesols dans un vase.', 'tournesols.jpg', 'Huile sur toile', 'Peinture', '92.1 × 73 cm', 'Post-impressionnisme', TRUE),
('Guernica', 2, '1937', 'Puissante représentation des horreurs de la guerre civile espagnole.', 'guernica.jpg', 'Huile sur toile', 'Peinture', '3.49 × 7.77 m', 'Cubisme', TRUE),
('Les Demoiselles d\'Avignon', 2, '1907', 'Tableau révolutionnaire marquant les débuts du cubisme.', 'demoiselles-avignon.jpg', 'Huile sur toile', 'Peinture', '243.9 × 233.7 cm', 'Cubisme', TRUE),
('Nymphéas', 3, '1914-1926', 'Série d\'environ 250 peintures représentant le jardin de fleurs de Monet à Giverny.', 'nympheas.jpg', 'Huile sur toile', 'Peinture', 'Dimensions variables', 'Impressionnisme', TRUE),
('La Joconde', 5, '1503-1519', 'Portrait le plus célèbre au monde, aussi appelé Mona Lisa.', 'joconde.jpg', 'Huile sur peuplier', 'Peinture', '77 × 53 cm', 'Renaissance', TRUE),
('La Persistance de la mémoire', 7, '1931', 'Célèbre pour ses montres molles, symbole du surréalisme.', 'montres-molles.jpg', 'Huile sur toile', 'Peinture', '24 × 33 cm', 'Surréalisme', TRUE),
('La Création d\'Adam', 8, '1512', 'Fresque représentant Dieu donnant la vie à Adam.', 'creation-adam.jpg', 'Fresque', 'Peinture murale', '280 × 570 cm', 'Renaissance', TRUE),
('Autoportrait aux cheveux coupés', 4, '1940', 'Autoportrait de Frida Kahlo après sa séparation avec Diego Rivera.', 'frida-autoportrait.jpg', 'Huile sur toile', 'Peinture', '40 × 28 cm', 'Surréalisme', FALSE),
('Number 5, 1948', 10, '1948', 'Exemple célèbre de la technique du "dripping" de Pollock.', 'number5.jpg', 'Peinture à l\'huile et laque sur toile', 'Peinture', '2.4 × 1.2 m', 'Expressionnisme abstrait', FALSE),
('La Jeune Fille à la perle', 9, '1665', 'Souvent appelée la "Mona Lisa du Nord".', 'jeune-fille-perle.jpg', 'Huile sur toile', 'Peinture', '44.5 × 39 cm', 'Âge d\'or néerlandais', TRUE),
('Le Cri', 9, '1893', 'Œuvre expressionniste représentant une figure angoissée.', 'le-cri.jpg', 'Tempera et pastel sur carton', 'Peinture', '91 × 73.5 cm', 'Expressionnisme', TRUE),
('Les Joueurs de cartes', 1, '1890-1892', 'Série de cinq tableaux représentant des paysans jouant aux cartes.', 'joueurs-cartes.jpg', 'Huile sur toile', 'Peinture', 'Dimensions variables', 'Post-impressionnisme', FALSE),
('La Danse', 2, '1910', 'Représentation de figures dansant en cercle, marquant le début du cubisme analytique.', 'la-danse.jpg', 'Huile sur toile', 'Peinture', '260 × 391 cm', 'Cubisme', FALSE),
('Le Déjeuner sur l\'herbe', 3, '1863', 'Scène de pique-nique controversée pour son réalisme.', 'dejeuner-herbe.jpg', 'Huile sur toile', 'Peinture', '208 × 264.5 cm', 'Impressionnisme', TRUE);

-- Expositions
INSERT INTO exhibitions (title, slug, description, start_date, end_date, location, cover_image, short_description, duration, is_featured, is_current) VALUES
('Van Gogh: Les Années Françaises', 'van-gogh-annees-francaises', 'Exposition majeure sur la période française de Van Gogh, où il a développé son style unique.', '2023-10-10', '2024-02-25', 'Galerie Principale', 'van-gogh-expo.jpg', 'Découvrez les œuvres créées par Van Gogh pendant son séjour en France.', 90, TRUE, FALSE),
('Picasso et le Cubisme', 'picasso-cubisme', 'Exploration approfondie des innovations cubistes de Picasso.', '2024-03-15', '2024-07-20', 'Aile Moderne', 'picasso-expo.jpg', 'Une plongée dans la révolution cubiste initiée par Picasso.', 75, TRUE, TRUE),
('Monet: L\'Œuvre Ultime', 'monet-oeuvre-ultime', 'Focus sur les dernières œuvres de Monet, notamment les Nymphéas.', '2023-05-20', '2023-09-15', 'Salle Impressionniste', 'monet-expo.jpg', 'Les magnifiques paysages d\'eau et de lumière de Monet.', 60, FALSE, FALSE),
('Femmes Artistes à Travers les Siècles', 'femmes-artistes', 'Hommage aux artistes femmes souvent négligées par l\'histoire de l\'art.', '2024-01-10', '2024-04-10', 'Galerie Est', 'femmes-artistes-expo.jpg', 'Redécouvrez les contributions des femmes à l\'histoire de l\'art.', 80, TRUE, FALSE),
('Renaissance: Naissance d\'une Nouvelle Vision', 'renaissance-vision', 'Exploration des innovations artistiques de la Renaissance.', '2024-08-01', '2024-12-15', 'Aile Historique', 'renaissance-expo.jpg', 'L\'art comme miroir des bouleversements intellectuels de la Renaissance.', 120, TRUE, FALSE),
('Surréalisme: Au-Delà de la Réalité', 'surrealisme-realite', 'Voyage dans l\'univers onirique des surréalistes.', '2023-11-15', '2024-03-01', 'Salle Contemporaine', 'surrealisme-expo.jpg', 'Explorez les limites de la réalité avec les maîtres du surréalisme.', 90, FALSE, FALSE),
('Expressionnisme Abstrait: L\'Émotion Pure', 'expressionnisme-abstrait', 'Exposition consacrée au mouvement expressionniste abstrait américain.', '2024-05-10', '2024-09-30', 'Aile Moderne', 'expressionnisme-expo.jpg', 'La puissance émotionnelle de l\'abstraction.', 70, FALSE, TRUE),
('L\'Âge d\'Or Néerlandais', 'age-or-neerlandais', 'Maitres de la peinture néerlandaise du XVIIe siècle.', '2023-09-01', '2024-01-15', 'Galerie Nord', 'neerlandais-expo.jpg', 'Rembrandt, Vermeer et leurs contemporains.', 100, TRUE, FALSE),
('Art et Technologie', 'art-technologie', 'Exploration des intersections entre art et innovations technologiques.', '2024-06-15', '2024-10-30', 'Espace Expérimental', 'art-tech-expo.jpg', 'Comment la technologie transforme la création artistique.', 50, FALSE, TRUE),
('Miniatures Persanes', 'miniatures-persanes', 'Collection rare de miniatures persanes du XVe au XVIIIe siècle.', '2023-12-10', '2024-04-20', 'Cabinet des Dessins', 'persanes-expo.jpg', 'L\'art délicat et raffiné de la miniature persane.', 45, FALSE, FALSE);

-- Liaisons exposition/œuvres
INSERT INTO exhibition_artworks (exhibition_id, artwork_id, display_order) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 13, 3),
(2, 3, 1),
(2, 4, 2),
(2, 14, 3),
(3, 5, 1),
(4, 9, 1),
(5, 6, 1),
(5, 8, 2),
(6, 7, 1),
(7, 10, 1),
(8, 11, 1),
(8, 12, 2),
(9, 15, 1);

-- Collections
INSERT INTO collections (name, slug, description, cover_image) VALUES
('Chefs-d\'œuvre de la Renaissance', 'chefs-doeuvre-renaissance', 'Collection emblématique des plus grands artistes de la Renaissance.', 'renaissance-collection.jpg'),
('Impressionnisme et Post-impressionnisme', 'impressionnisme-post', 'Collection majeure des maîtres de la lumière et de la couleur.', 'impressionnisme-collection.jpg'),
('Art Moderne: Cubisme et Surréalisme', 'art-moderne', 'Œuvres révolutionnaires du début du XXe siècle.', 'moderne-collection.jpg'),
('Expressionnisme Abstrait', 'expressionnisme-abstrait', 'Collection d\'art abstrait américain d\'après-guerre.', 'abstrait-collection.jpg'),
('Dessins et Estampes', 'dessins-estampes', 'Collection de travaux sur papier du XVe au XXe siècle.', 'dessins-collection.jpg'),
('Art Asiatique', 'art-asiatique', 'Collection exceptionnelle d\'art asiatique ancien.', 'asiatique-collection.jpg'),
('Sculptures Européennes', 'sculptures-europeennes', 'Collection de sculptures du Moyen Âge au XIXe siècle.', 'sculptures-collection.jpg'),
('Photographie Contemporaine', 'photographie-contemporaine', 'Œuvres photographiques des années 1960 à nos jours.', 'photo-collection.jpg'),
('Art Africain Traditionnel', 'art-africain', 'Masques et sculptures des cultures africaines traditionnelles.', 'africain-collection.jpg'),
('Art Précolombien', 'art-precolombien', 'Objets d\'art des civilisations maya, aztèque et inca.', 'precolombien-collection.jpg');

-- Utilisateurs
INSERT INTO users (email, password_hash, first_name, last_name, is_admin) VALUES
('admin@musee-art.fr', '$2y$10$H.d8J3u5XjZ7qV7vQ5z.weJ9Nc0uYbJf6zJkLm1XqGtWbY2sS5vO', 'Jean', 'Dupont', TRUE),
('curator@musee-art.fr', '$2y$10$H.d8J3u5XjZ7qV7vQ5z.weJ9Nc0uYbJf6zJkLm1XqGtWbY2sS5vO', 'Marie', 'Martin', TRUE),
('guide@musee-art.fr', '$2y$10$H.d8J3u5XjZ7qV7vQ5z.weJ9Nc0uYbJf6zJkLm1XqGtWbY2sS5vO', 'Pierre', 'Bernard', FALSE),
('visiteur1@example.com', '$2y$10$H.d8J3u5XjZ7qV7vQ5z.weJ9Nc0uYbJf6zJkLm1XqGtWbY2sS5vO', 'Sophie', 'Leroy', FALSE),
('visiteur2@example.com', '$2y$10$H.d8J3u5XjZ7qV7vQ5z.weJ9Nc0uYbJf6zJkLm1XqGtWbY2sS5vO', 'Thomas', 'Petit', FALSE),
('membre@example.com', '$2y$10$H.d8J3u5XjZ7qV7vQ5z.weJ9Nc0uYbJf6zJkLm1XqGtWbY2sS5vO', 'Camille', 'Roux', FALSE),
('etudiant.art@example.com', '$2y$10$H.d8J3u5XjZ7qV7vQ5z.weJ9Nc0uYbJf6zJkLm1XqGtWbY2sS5vO', 'Lucas', 'Moreau', FALSE),
('professeur@example.com', '$2y$10$H.d8J3u5XjZ7qV7vQ5z.weJ9Nc0uYbJf6zJkLm1XqGtWbY2sS5vO', 'Isabelle', 'Fontaine', FALSE),
('journaliste@example.com', '$2y$10$H.d8J3u5XjZ7qV7vQ5z.weJ9Nc0uYbJf6zJkLm1XqGtWbY2sS5vO', 'David', 'Lefevre', FALSE),
('sponsor@example.com', '$2y$10$H.d8J3u5XjZ7qV7vQ5z.weJ9Nc0uYbJf6zJkLm1XqGtWbY2sS5vO', 'Nathalie', 'Dubois', FALSE);

-- Newsletters
INSERT INTO newsletters (email, is_active, reminders_enabled) VALUES
('visiteur1@example.com', TRUE, TRUE),
('visiteur2@example.com', TRUE, FALSE),
('membre@example.com', TRUE, TRUE),
('etudiant.art@example.com', FALSE, FALSE),
('nouveau@example.com', TRUE, TRUE),
('artlover@example.com', TRUE, TRUE),
('culture@example.com', TRUE, FALSE),
('test@example.com', FALSE, FALSE),
('abonne@example.com', TRUE, TRUE),
('ancien@example.com', FALSE, FALSE);

-- Membres d'équipe
INSERT INTO team_members (name, position, department, bio, photo, email, twitter, linkedin, display_order) VALUES
('Élodie Laurent', 'Directrice du musée', 'direction', 'Diplômée de l\'École du Louvre, Élodie dirige le musée depuis 2015 avec une vision innovante.', 'laurent.jpg', 'direction@musee-art.fr', 'elo_laurent', 'elodielaurent', 1),
('Marc Vidal', 'Conservateur en chef', 'curation', 'Spécialiste de l\'art moderne, Marc a organisé de nombreuses expositions primées.', 'vidal.jpg', 'curation@musee-art.fr', 'marc_vidal_art', 'marcvidal', 2),
('Sophie Nguyen', 'Responsable des collections', 'curation', 'Experte en art asiatique, Sophie supervise l\'entretien et la restauration des œuvres.', 'nguyen.jpg', 'collections@musee-art.fr', NULL, 'sophienguyen', 3),
('Thomas Morel', 'Chef des services techniques', 'technique', 'Responsable de l\'installation des expositions et de la sécurité des œuvres.', 'morel.jpg', 'technique@musee-art.fr', NULL, 'thomasmorel', 4),
('Claire Dubois', 'Responsable pédagogique', 'education', 'Conçoit les programmes éducatifs pour les écoles et les familles.', 'dubois.jpg', 'education@musee-art.fr', 'claire_edu', 'clairedubois', 5),
('Antoine Rousseau', 'Responsable communication', 'communication', 'Gère les relations presse et les stratégies de communication du musée.', 'rousseau.jpg', 'communication@musee-art.fr', 'antoine_com', 'antoinerousseau', 6);

-- Partenaires
INSERT INTO partners (name, logo, website, partnership_type, since_year, description) VALUES
('Fondation Art et Culture', 'fondation-art.jpg', 'https://fondation-art.org', 'institutionnel', 2010, 'Soutien financier pour les acquisitions et les expositions temporaires.'),
('TechnoArt Solutions', 'technoart.jpg', 'https://technoart.com', 'technologique', 2018, 'Fournisseur de solutions d\'éclairage et de contrôle climatique pour les œuvres.'),
('Université des Arts', 'univ-arts.jpg', 'https://universite-arts.edu', 'academique', 2005, 'Collaboration sur des projets de recherche et programmes éducatifs.'),
('Galerie Internationale', 'galerie-int.jpg', 'https://galerie-internationale.com', 'culturel', 2015, 'Prêts d\'œuvres et échanges culturels internationaux.'),
('Banque Patrimoniale', 'banque-patrimoine.jpg', 'https://banque-patrimoine.com', 'institutionnel', 2012, 'Mécénat pour la restauration des collections.'),
('Art Magazine', 'art-mag.jpg', 'https://art-magazine.com', 'culturel', 2020, 'Partenariat média pour la promotion des expositions.');

-- Timeline historique
INSERT INTO history_timeline (year, title, description, image, display_order) VALUES
('1875', 'Fondation du musée', 'Le musée est fondé grâce au legs de la collection personnelle du mécène Édouard Lambert.', 'fondation.jpg', 1),
('1923', 'Première extension', 'Construction de l\'aile est pour accueillir les collections d\'art moderne.', 'extension-1923.jpg', 2),
('1945', 'Réouverture après-guerre', 'Le musée rouvre après des années de fermeture et de protection des collections.', 'reouverture-1945.jpg', 3),
('1978', 'Acquisition de la collection Durand', 'Le musée acquiert 150 œuvres majeures de la collection privée Durand.', 'collection-durand.jpg', 4),
('2001', 'Rénovation majeure', 'Travaux de modernisation et d\'accessibilité pour tout le bâtiment.', 'renovation-2001.jpg', 5),
('2015', 'Ouverture de l\'aile contemporaine', 'Nouvel espace dédié à l\'art contemporain et aux installations numériques.', 'aile-contemporaine.jpg', 6);

-- Rappels d'exposition
INSERT INTO exhibition_reminders (exhibition_id, email, token, is_confirmed, wants_newsletter) VALUES
(2, 'visiteur1@example.com', 'token123', TRUE, TRUE),
(2, 'membre@example.com', 'token456', TRUE, FALSE),
(7, 'artlover@example.com', 'token789', TRUE, TRUE),
(7, 'nouveau@example.com', 'tokenabc', FALSE, TRUE),
(2, 'test@example.com', 'tokendef', TRUE, FALSE);

-- Statistiques d'exposition
INSERT INTO exhibition_stats (exhibition_id, day, views, unique_visitors, shares, reminders) VALUES
(1, '2023-10-15', 342, 287, 45, 32),
(1, '2023-10-16', 298, 254, 38, 28),
(1, '2023-10-17', 412, 356, 67, 41),
(2, '2024-03-20', 587, 489, 92, 76),
(2, '2024-03-21', 623, 512, 104, 82),
(7, '2024-05-15', 231, 198, 34, 21),
(7, '2024-05-16', 276, 234, 41, 29);

-- Partages d'exposition
INSERT INTO exhibition_shares (exhibition_id, platform) VALUES
(1, 'facebook'),
(1, 'twitter'),
(1, 'facebook'),
(2, 'pinterest'),
(2, 'link'),
(2, 'facebook'),
(2, 'facebook'),
(7, 'twitter'),
(7, 'other'),
(1, 'pinterest');

-- Soumissions de contact
INSERT INTO contact_submissions (name, email, subject, department, message, status) VALUES
('Paul Durand', 'paul@example.com', 'Demande d\'informations sur les visites guidées', 'education', 'Bonjour, je souhaiterais organiser une visite guidée pour un groupe scolaire. Quelles sont les disponibilités?', 'resolved'),
('Marie Lambert', 'marie.l@example.com', 'Proposition de partenariat', 'partnerships', 'Notre entreprise souhaiterait discuter d\'un possible partenariat culturel.', 'in_progress'),
('Jean Petit', 'jeanp@example.com', 'Problème technique sur le site web', 'technical', 'Je n\'arrive pas à finaliser mon achat de billets en ligne. Le paiement échoue systématiquement.', 'new'),
('Sophie Martin', 'sophie.m@example.com', 'Demande d\'interview', 'press', 'Je suis journaliste pour Art Magazine et souhaiterais interviewer le conservateur.', 'in_progress'),
('Thomas Leroy', 't.leroy@example.com', 'Question sur une œuvre', 'general', 'Bonjour, je recherche des informations sur la restauration de "La Nuit étoilée".', 'new'),
('Alice Dubois', 'alice.d@example.com', 'Demande de bénévole', 'general', 'Je souhaiterais m\'engager comme bénévole au musée. Comment procéder?', 'new');

-- FAQs
INSERT INTO faqs (question, answer, category, display_order) VALUES
('Quels sont les horaires d\'ouverture?', 'Le musée est ouvert du mardi au dimanche de 9h à 18h. Nocturne jusqu\'à 21h le jeudi.', 'general', 1),
('Y a-t-il des tarifs réduits?', 'Oui, des tarifs réduits sont disponibles pour les étudiants, seniors et groupes. Gratuit pour les moins de 18 ans.', 'visits', 2),
('Puis-je prendre des photos?', 'Les photos sans flash sont autorisées dans les collections permanentes, mais interdites dans les expositions temporaires.', 'general', 3),
('Comment devenir membre?', 'Rendez-vous sur notre site web ou à l\'accueil pour souscrire à un abonnement annuel avec de nombreux avantages.', 'general', 4),
('Le musée est-il accessible aux personnes à mobilité réduite?', 'Oui, tout le musée est accessible et des fauteuils roulants sont disponibles à l\'accueil.', 'visits', 5),
('Organisez-vous des visites en langue des signes?', 'Oui, des visites en LSF sont programmées chaque mois. Consultez notre agenda.', 'education', 6),
('Puis-je annuler ou modifier ma réservation?', 'Les billets peuvent être modifiés jusqu\'à 24h avant la visite. Aucun remboursement après achat.', 'visits', 7),
('Où puis-je manger dans le musée?', 'Notre café-restaurant au 1er étage propose des plats légers de 11h30 à 15h.', 'general', 8),
('Acceptez-vous les cartes de crédit étrangères?', 'Oui, nous acceptons toutes les principales cartes de crédit internationales.', 'general', 9),
('Comment proposer une œuvre pour acquisition?', 'Veuillez contacter notre département des collections par email avec photos et documentation.', 'general', 10);

-- Départements de contact
INSERT INTO contact_departments (name, slug, email, description, display_order, is_active) VALUES
('Informations générales', 'general', 'info@musee-art.fr', 'Pour toutes vos questions générales sur le musée.', 1, TRUE),
('Service éducatif', 'education', 'education@musee-art.fr', 'Réservations pour les groupes scolaires et activités pédagogiques.', 2, TRUE),
('Partenariats et mécénat', 'partnerships', 'partenariats@musee-art.fr', 'Pour les entreprises et institutions souhaitant collaborer.', 3, TRUE),
('Presse', 'press', 'presse@musee-art.fr', 'Demandes d\'interviews, accréditations et dossiers de presse.', 4, TRUE),
('Services techniques', 'technical', 'technique@musee-art.fr', 'Problèmes techniques sur le site web ou les installations.', 5, TRUE);

-- Coordonnées du musée
INSERT INTO museum_contact_info (address, phone, email, opening_hours, map_iframe_code, social_links) VALUES
('1 Rue des Arts, 75001 Paris, France', '+33123456789', 'contact@musee-art.fr', 'Mardi-Dimanche: 9h-18h\nJeudi: 9h-21h\nFermé le lundi', '<iframe src="https://maps.google.com/maps?q=1+Rue+des+Arts,+75001+Paris&output=embed" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>', '{
  "facebook": "https://facebook.com/museeart",
  "twitter": "https://twitter.com/museeart",
  "instagram": "https://instagram.com/museeart",
  "youtube": "https://youtube.com/museeart"
}');