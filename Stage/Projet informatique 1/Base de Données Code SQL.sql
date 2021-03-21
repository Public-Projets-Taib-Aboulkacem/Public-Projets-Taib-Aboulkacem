DROP DATABASE controler_transitions;
#-- Base de données: `controler_transitions`
CREATE DATABASE IF NOT EXISTS controler_transitions;
#création des table 
#--table Admin_academie
CREATE TABLE controler_transitions.admin_academie(
id_admin INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
nom_prenom_admin varchar(255) NOT NULL,
pass_admin varchar(255) NOT NULL,
email_admin varchar(255) NOT NULL,
academie_admin varchar(255) NOT NULL,
date_inscription_admin Timestamp NOT NULL
)ENGINE=MyISAM;
#--table user pour les utilisateur
CREATE TABLE controler_transitions.user( 
id_user INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
id_academie_user varchar(255) NOT NULL,
nom_prenom_user varchar(255) NOT NULL,
metier_user varchar(255) NOT NULL,
pass_user varchar(255) NOT NULL,
email_user varchar(255) NOT NULL,
ville_user varchar(255) NOT NULL,
ecole_user varchar(255) NOT NULL,
date_inscription_user Timestamp NOT NULL,
Foreign key (id_academie_user) references admin_academie (id_admin)
)ENGINE=MyISAM;
#--table Dommande
CREATE TABLE controler_transitions.dommande(
id_dommande INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
id_user INT(11) NOT NULL,
id_admin INT(11) NOT NULL,
id_academie_rechercher varchar(255) NOT NULL,
ville_rechercher varchar(255) NOT NULL,
ecole_rechercher varchar(255) NOT NULL,
date_dommande_user Timestamp NOT NULL,
Foreign key (id_user) references user (id_user),
Foreign key (id_admin) references user (id_academie_user),
Foreign key (id_academie_rechercher) references admin_academie (id_admin)
)ENGINE=MyISAM;
################ les table system: #####################
#--table message system :
CREATE TABLE controler_transitions.msg_system_admin_user(
id_msg INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
envoi_a INT(11) NOT NULL,
envoi_par INT(11) NOT NULL,
message varchar(255) Not null,
date_msg Timestamp NOT NULL,
Foreign key (envoi_par) references admin (id_admin),
Foreign key (envoi_a) references user (id_user)
)ENGINE=MyISAM;
#--table message system :
CREATE TABLE controler_transitions.msg_system_user_admin(
id_msg INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
envoi_a INT(11) NOT NULL,
envoi_par INT(11) NOT NULL,
message varchar(255) Not null,
date_msg Timestamp NOT NULL,
Foreign key (envoi_par) references user (id_user),
Foreign key (envoi_a) references admin (id_admin)
)ENGINE=MyISAM;
#--table message system :
CREATE TABLE controler_transitions.msg_system_user_user(
id_msg INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
envoi_a INT(11) NOT NULL,
envoi_par INT(11) NOT NULL,
message varchar(255) Not null,
date_msg Timestamp NOT NULL,
Foreign key (envoi_par) references user (id_user),
Foreign key (envoi_a) references user (id_user)
)ENGINE=MyISAM;
#--table message system :
CREATE TABLE controler_transitions.msg_system_admin_admin(
id_msg INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
envoi_a INT(11) NOT NULL,
envoi_par INT(11) NOT NULL,
message varchar(255) Not null,
date_msg Timestamp NOT NULL,
Foreign key (envoi_par) references admin (id_user),
Foreign key (envoi_a) references admin (id_user)
)ENGINE=MyISAM;
#--table analyse system :
CREATE TABLE controler_transitions.analyse_dommande(
id_analyse INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
id_dommande INT(11) NOT NULL,
id_user INT(11) NOT NULL,
id_user_peut_etre INT(11) NOT NULL,
id_admin_peut_etre INT(11) NOT NULL,
dommande varchar(255) NOT NULL DEFAULT "non",
date_dommande Timestamp NOT NULL,
d_accord_user varchar(255) NOT NULL DEFAULT "non",
date_daccord_user Timestamp NOT NULL,
d_accord_admin_moi varchar(255) NOT NULL DEFAULT "non",
date_daccord_ad_moi Timestamp NOT NULL,
d_accord_admin_toi varchar(255) NOT NULL DEFAULT "non",
date_daccord_ad_toi Timestamp NOT NULL,
Foreign key (id_dommande) references dommande (id_dommande),
Foreign key (id_user) references user (id_user),
Foreign key (id_user_peut_etre) references user (id_user),
Foreign key (id_admin_peut_etre) references admin_academie (id_admin)
)ENGINE=MyISAM;
