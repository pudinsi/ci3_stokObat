--
---
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_nama` varchar(128) NOT NULL,
  `users_email` varchar(128) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_active` tinyint(1) unsigned NOT NULL,
  `users_level` enum('Admin', 'Guest') NOT NULL,
  `users_token` varchar(255) NOT NULL,
  `users_tgl_input` datetime NOT NULL,
  `users_tgl_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_users`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- pasword 1234
--
INSERT INTO `users` (`users_nama`, `users_email`, `users_password`, `users_active`, `users_level`, `users_token`, `users_tgl_input`, `users_tgl_edit`) VALUES
('Admin Utama', 'admin@email.id', '$2y$10$YJx2/v2TlngG5HgmQwMf1Onmd2iARDaXf7ZVpStmvXaGD2y57q2lW', 1, 'Admin', '', '2021-05-21 23:51:23', '2021-05-21 16:51:23');
