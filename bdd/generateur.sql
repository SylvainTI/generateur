-- phpMyAdmin SQL Dump
-- version 2.11.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 11 Septembre 2011 à 15:56
-- Version du serveur: 5.0.44
-- Version de PHP: 5.2.5-pl1-gentoo

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `samszo`
--

-- --------------------------------------------------------

--
-- Structure de la table `gen_adjectifs`
--

DROP TABLE IF EXISTS `gen_adjectifs`;
CREATE TABLE IF NOT EXISTS `gen_adjectifs` (
  `id_adj` int(11) NOT NULL auto_increment,
  `id_dico` int(11) NOT NULL,
  `elision` int(11) NOT NULL,
  `prefix` varchar(255) collate utf8_bin NOT NULL,
  `m_s` varchar(255) collate utf8_bin NOT NULL,
  `f_s` varchar(255) collate utf8_bin NOT NULL,
  `m_p` varchar(255) collate utf8_bin NOT NULL,
  `f_p` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id_adj`),
  KEY `id_dico` (`id_dico`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC AUTO_INCREMENT=43865 ;

-- --------------------------------------------------------

--
-- Structure de la table `gen_complements`
--

DROP TABLE IF EXISTS `gen_complements`;
CREATE TABLE IF NOT EXISTS `gen_complements` (
  `id_cpm` int(11) NOT NULL auto_increment,
  `id_dico` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  `lib` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id_cpm`),
  KEY `id_dico` (`id_dico`),
  KEY `num` (`num`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC AUTO_INCREMENT=666 ;

-- --------------------------------------------------------

--
-- Structure de la table `gen_concepts`
--

DROP TABLE IF EXISTS `gen_concepts`;
CREATE TABLE IF NOT EXISTS `gen_concepts` (
  `id_concept` int(11) NOT NULL auto_increment,
  `id_dico` int(11) NOT NULL,
  `lib` varchar(255) collate utf8_bin NOT NULL,
  `type` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id_concept`),
  KEY `id_dico` (`id_dico`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=121228 ;

-- --------------------------------------------------------

--
-- Structure de la table `gen_concepts_adjectifs`
--

DROP TABLE IF EXISTS `gen_concepts_adjectifs`;
CREATE TABLE IF NOT EXISTS `gen_concepts_adjectifs` (
  `id_concept` int(11) NOT NULL,
  `id_adj` int(11) NOT NULL,
  PRIMARY KEY  (`id_concept`,`id_adj`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `gen_concepts_conjugaisons`
--

DROP TABLE IF EXISTS `gen_concepts_conjugaisons`;
CREATE TABLE IF NOT EXISTS `gen_concepts_conjugaisons` (
  `id_concept` int(11) NOT NULL,
  `id_conj` int(11) NOT NULL,
  PRIMARY KEY  (`id_concept`,`id_conj`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `gen_concepts_generateurs`
--

DROP TABLE IF EXISTS `gen_concepts_generateurs`;
CREATE TABLE IF NOT EXISTS `gen_concepts_generateurs` (
  `id_concept` int(11) NOT NULL,
  `id_gen` int(11) NOT NULL,
  PRIMARY KEY  (`id_concept`,`id_gen`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `gen_concepts_substantifs`
--

DROP TABLE IF EXISTS `gen_concepts_substantifs`;
CREATE TABLE IF NOT EXISTS `gen_concepts_substantifs` (
  `id_concept` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  PRIMARY KEY  (`id_concept`,`id_sub`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `gen_concepts_syntagmes`
--

DROP TABLE IF EXISTS `gen_concepts_syntagmes`;
CREATE TABLE IF NOT EXISTS `gen_concepts_syntagmes` (
  `id_concept` int(11) NOT NULL,
  `id_syn` int(11) NOT NULL,
  PRIMARY KEY  (`id_concept`,`id_syn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `gen_concepts_verbes`
--

DROP TABLE IF EXISTS `gen_concepts_verbes`;
CREATE TABLE IF NOT EXISTS `gen_concepts_verbes` (
  `id_concept` int(11) NOT NULL,
  `id_verbe` int(11) NOT NULL,
  PRIMARY KEY  (`id_concept`,`id_verbe`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `gen_conjugaisons`
--

DROP TABLE IF EXISTS `gen_conjugaisons`;
CREATE TABLE IF NOT EXISTS `gen_conjugaisons` (
  `id_conj` int(11) NOT NULL auto_increment,
  `id_dico` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `modele` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id_conj`),
  KEY `num` (`num`),
  KEY `id_dico` (`id_dico`),
  KEY `modele` (`modele`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1008 ;

-- --------------------------------------------------------

--
-- Structure de la table `gen_determinants`
--

DROP TABLE IF EXISTS `gen_determinants`;
CREATE TABLE IF NOT EXISTS `gen_determinants` (
  `id_dtm` int(11) NOT NULL auto_increment,
  `id_dico` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  `lib` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id_dtm`),
  KEY `num` (`num`),
  KEY `id_dico` (`id_dico`),
  KEY `lib` (`lib`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4661 ;

-- --------------------------------------------------------

--
-- Structure de la table `gen_dicos`
--

DROP TABLE IF EXISTS `gen_dicos`;
CREATE TABLE IF NOT EXISTS `gen_dicos` (
  `id_dico` int(11) NOT NULL auto_increment,
  `nom` varchar(255) collate utf8_bin NOT NULL,
  `url` varchar(255) collate utf8_bin NOT NULL,
  `type` varchar(255) collate utf8_bin NOT NULL,
  `maj` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `url_source` varchar(255) collate utf8_bin NOT NULL,
  `path_source` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id_dico`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC AUTO_INCREMENT=89 ;

-- --------------------------------------------------------

--
-- Structure de la table `gen_dicos_dicos`
--

DROP TABLE IF EXISTS `gen_dicos_dicos`;
CREATE TABLE IF NOT EXISTS `gen_dicos_dicos` (
  `id_dico_gen` int(11) NOT NULL,
  `id_dico_ref` int(11) NOT NULL,
  PRIMARY KEY  (`id_dico_gen`,`id_dico_ref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `gen_generateurs`
--

DROP TABLE IF EXISTS `gen_generateurs`;
CREATE TABLE IF NOT EXISTS `gen_generateurs` (
  `id_gen` int(11) NOT NULL auto_increment,
  `id_dico` int(11) NOT NULL,
  `valeur` varchar(2000) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id_gen`),
  KEY `id_dico` (`id_dico`),
  KEY `valeur` (`valeur`(333))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=159318 ;

-- --------------------------------------------------------

--
-- Structure de la table `gen_negations`
--

DROP TABLE IF EXISTS `gen_negations`;
CREATE TABLE IF NOT EXISTS `gen_negations` (
  `id_negation` int(11) NOT NULL auto_increment,
  `id_dico` int(11) NOT NULL,
  `lib` varchar(50) collate utf8_unicode_ci NOT NULL,
  `num` int(11) NOT NULL,
  PRIMARY KEY  (`id_negation`),
  KEY `id_dico` (`id_dico`,`num`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Structure de la table `gen_oeuvres`
--

DROP TABLE IF EXISTS `gen_oeuvres`;
CREATE TABLE IF NOT EXISTS `gen_oeuvres` (
  `id_oeu` int(11) NOT NULL auto_increment,
  `lib` varchar(255) collate utf8_unicode_ci NOT NULL,
  `maj` datetime NOT NULL,
  PRIMARY KEY  (`id_oeu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `gen_oeuvres_dicos`
--

DROP TABLE IF EXISTS `gen_oeuvres_dicos`;
CREATE TABLE IF NOT EXISTS `gen_oeuvres_dicos` (
  `id_oeu` int(11) NOT NULL,
  `id_dico` int(11) NOT NULL,
  PRIMARY KEY  (`id_oeu`,`id_dico`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gen_pronoms`
--

DROP TABLE IF EXISTS `gen_pronoms`;
CREATE TABLE IF NOT EXISTS `gen_pronoms` (
  `id_pronom` int(11) NOT NULL auto_increment,
  `id_dico` int(11) NOT NULL,
  `type` varchar(50) collate utf8_unicode_ci NOT NULL,
  `num` int(11) NOT NULL,
  `lib` varchar(50) collate utf8_unicode_ci NOT NULL,
  `lib_eli` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_pronom`),
  KEY `num` (`num`),
  KEY `id_dico` (`id_dico`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=329 ;

-- --------------------------------------------------------

--
-- Structure de la table `gen_substantifs`
--

DROP TABLE IF EXISTS `gen_substantifs`;
CREATE TABLE IF NOT EXISTS `gen_substantifs` (
  `id_sub` int(11) NOT NULL auto_increment,
  `id_dico` int(11) NOT NULL,
  `elision` int(11) NOT NULL,
  `prefix` varchar(255) collate utf8_bin NOT NULL,
  `genre` int(11) NOT NULL,
  `s` varchar(255) collate utf8_bin NOT NULL,
  `p` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id_sub`),
  KEY `id_dico` (`id_dico`),
  KEY `prefix` (`prefix`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC AUTO_INCREMENT=107819 ;

-- --------------------------------------------------------

--
-- Structure de la table `gen_syntagmes`
--

DROP TABLE IF EXISTS `gen_syntagmes`;
CREATE TABLE IF NOT EXISTS `gen_syntagmes` (
  `id_syn` int(11) NOT NULL auto_increment,
  `id_dico` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  `lib` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id_syn`),
  KEY `num` (`num`),
  KEY `id_dico` (`id_dico`),
  KEY `lib` (`lib`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4005 ;

-- --------------------------------------------------------

--
-- Structure de la table `gen_terminaisons`
--

DROP TABLE IF EXISTS `gen_terminaisons`;
CREATE TABLE IF NOT EXISTS `gen_terminaisons` (
  `id_trm` int(11) NOT NULL auto_increment,
  `id_conj` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `lib` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id_trm`),
  KEY `id_conj` (`id_conj`),
  KEY `lib` (`lib`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=37881 ;

-- --------------------------------------------------------

--
-- Structure de la table `gen_verbes`
--

DROP TABLE IF EXISTS `gen_verbes`;
CREATE TABLE IF NOT EXISTS `gen_verbes` (
  `id_verbe` int(11) NOT NULL auto_increment,
  `id_conj` int(11) NOT NULL,
  `id_dico` int(11) NOT NULL,
  `elision` int(11) NOT NULL,
  `prefix` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id_verbe`),
  KEY `id_dico` (`id_dico`),
  KEY `id_conj` (`id_conj`),
  KEY `prefix` (`prefix`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC AUTO_INCREMENT=22731 ;