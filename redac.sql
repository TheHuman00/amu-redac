CREATE TABLE `missions_ambu` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_rapports` int(11) NOT NULL,
  `id_mission` int(11) NOT NULL,
  `title` blob,
  `num_mission` varchar(255) DEFAULT NULL,
  `date_heure` blob,
  `motif` blob,
  `bilan_cir` blob,
  `sexe` blob,
  `age` text,
  `antcd` blob,
  `SSS` blob,
  `EPADONO` text,
  `position` blob,
  `airways_ql` blob,
  `breathing_ql` blob,
  `circulation_ql` blob,
  `a` blob,
  `b` blob,
  `c` blob,
  `d` blob,
  `e` blob,
  `actes` blob,
  `reevalution` blob,
  `autre_moyen` blob,
  `actes_stagiaire` blob,
  `surveillance` blob,
  `diff` blob,
  `eval` blob,
  `patho` blob,
  `ressenti` blob,
  `fini` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `missions_smur` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_rapports` int(11) NOT NULL,
  `id_mission` int(11) NOT NULL,
  `title` blob,
  `num_mission` varchar(255) DEFAULT NULL,
  `date_heure` blob,
  `motif` blob,
  `bilan_cir` blob,
  `sexe` blob,
  `age` text,
  `antcd` blob,
  `SSS` blob,
  `EPADONO` text,
  `position` blob,
  `airways_ql` blob,
  `breathing_ql` blob,
  `circulation_ql` blob,
  `a` blob,
  `b` blob,
  `c` blob,
  `d` blob,
  `e` blob,
  `actes` blob,
  `reevalution` blob,
  `autre_moyen` blob,
  `actes_stagiaire` blob,
  `surveillance` blob,
  `diff` blob,
  `eval` blob,
  `patho` blob,
  `ressenti` blob,
  `fini` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `rapports` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` text NOT NULL,
  `nom` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `annee` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `missions_ambu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_combination` (`id_rapports`,`id_mission`);

ALTER TABLE `missions_smur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_combination` (`id_rapports`,`id_mission`);

ALTER TABLE `rapports`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `missions_ambu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

ALTER TABLE `missions_smur`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

ALTER TABLE `rapports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;