# Principes de la génération littéraire #
:© Jean-Pierre BALPE




# 1. Définitions préliminaires #

## 1.1. La génération automatique : ##

:On considérera comme générateur automatique un automate capable de produire en quantité psychologiquement illimitée des objets acceptables dans un domaine de communication antérieurement défini, c’est-à-dire reconnu comme domaine par une communauté de récepteurs (notion de village au sens de l’ethnométhodologie).


:Par exemple, un générateur automatique de roman produit un très grand nombre de pages acceptées par des lecteurs comme pages de roman; un générateur de scénario produit un très grand nombre de parcours, etc.


## 1.2. Syntaxe de génération : ##

:Les algorithmes de génération littéraire fonctionnent à partir d’une grammaire sémantique : ils considèrent la sémantique et la syntaxe comme équivalents à tous les niveaux. En ce sens, dans les lignes qui suivent, il faut comprendre “syntaxique” comme “sémantico-syntaxique” — désormais désignée sous le nom GRAMSEM.


:Le mode fondamental de fonctionnement est celui d’une grammaire.


:En son sens le plus général, cette grammaire peut-être définie comme une structure récursive à deux dimensions : dimension syntagmatique et dimension paradigmatique.


## 1.3. Récursivité de la génération : ##

:La génération automatique repose sur une stratification récursive de données, décrites de façon plus ou moins complexe, définissant autant de niveaux différents, du plus simple qui gère une simple combinatoire aléatoire indifférente aux langues au plus complexe gérant une vraie génération à partir de la totalité de la grammaire sémantique et syntaxique différente suivant les langues.


:Quoi qu’il en soit le générateur décrit ci-dessous cherche à éliminer les différences inter-langues par formalisation de ce que l’on peut appeler une métalangue. Cette métalangue est constituée de niveaux.


:Dans GRAMSEM ces niveaux définissent trois types de données : données textes, données intermédiaires, données finies. Ces types de données peuvent être récursifs. Le niveau TEXTE, par exemple, peut être lui-même constitué de données de type TEXTE, éventuellement, sous certaines conditions, renvoyant à lui-même en tant qu’objet. Le niveau intermédiaire également. Seul le niveau « fini » est non-récursif.

:[[Image: Image 0]]



:Si l’on appelle “développement” d’une donnée le parcours de la hiérarchie de ses classes jusqu’à obtention d’un élément terminal, l’écriture d’un texte n’est rien d’autre que le développement successif des niveaux de classes sur l’axe syntagmatique.


:Ce développement est la plupart du temps ordonné de gauche à droite. Les classes sont donc toujours potentiellement des graphes, c’est-à-dire des objets — ou des classes — liées par des relations d’ordre.


:Un texte est terminé lorsque le moteur ne trouve plus de données à développer. Exemple, TEXTE A




## 1.4. Structure générale du système de génération ##

:Le système de génération automatique est constitué de modules séparés faisant appel les uns aux autres en cas de besoin :


**::le module central — appelé ici MOTEUR — est le module de développement : il est extralinguistique** ::MOTEUR exploite un certain nombre de dictionnaires avec lesquels il est mis en relation soit de façon interactive, soit de façon automatique, soit de façon aléatoire
**::les dictionnaires portent les représentations des connaissances nécessaires et indiquent s’il est ou non besoin de connaissances linguistiques** ::Les dictionnaires utilisées sont : dictionnaire des textes, dictionnaire des représentations de connaissances et dictionnaire général.

:[[Image: Image 1]]



:Cet aspect modulaire est essentiel car il permet des usages multilingues rendues par ailleurs possibles par la conception métalinguistique des descripteurs.


<u>Dans une version multilingue diverses hypothèses de travail restent à définir :</u>


<u>Les dictionnaires généraux de langues peuvent être séparées et fonctionner comme autant d’entités autonomes</u>
<u>Les dictionnaires généraux de langues peuvent être confondus dans un seul dictionnaire général permettant des textes multilingues ou des relations d’une langue à l’autre.</u>

# 2. Objets de GRAMSEM : #

:Le générateur ne comporte donc fondamentalement que deux objets distincts :


**::des dictionnaire de données ou de graphes** ::des descripteurs syntaxiques interprétés par le moteur de génération.

:Les textes sont le produit de l’interprétation de ces deux objets. Le moteur de génération n’a pas d’autre fonction que d’exploiter les informations fournies par les données.


## 2.1. Nature des données : ##

## 2.1.1. Définition d’une donnée : ##

:Une donnée peut-être une classe ou un élément quelconque d'une classe. Une donnée est autonome en ce sens qu’elle porte l’ensemble des informations utiles à son utilisation par l’automate de génération. Ces informations sont représentées par des descripteurs.


### 2.1.2. États des données : ###

:Les données, quel que soit leur niveau, peuvent revêtir deux états :


**::état fini** ::état non-fini

:La finitude des états ne dépend que des possibilités de développement récursif. La récursivité est indiquée par le symbole ouvrant [et le symbole fermant ](.md) : une donnée contenue entre ces deux symboles est une donnée à développer. Par exemple : « [1](m_bonheur.md) » demande au MOTEUR d’aller chercher dans le dictionnaire général une des données correspondantes à cette donnée de niveau supérieur.


:L’état fini d’une donnée ne comporte plus aucun descripteur {{fn Les symboles utilisés ici par les descripteurs peuvent être adaptés en fonction des besoins du développement logiciel.}}. Il ne peut être que placé tel quel dans la chaîne de caractère qui constitue le texte.


:Exemple : “éléphant” ou “ce jour-là il pleuvait” sont des données finies.


:L’état non-fini d’une donnée comporte un ou plusieurs descripteurs syntaxico-sémantiques, il doit être développé par le moteur de génération avant d’être placé dans la chaîne de caractère qui constitue le texte. Exemple : “[1|m\_éléphant], 1(1)éléphant|s, [53#](53#.md) [0800000|v\_sortir]...” sont des données non-finies. Les descripteurs sont des objets formels identifiés dans un lexique de descripteurs (cf. en annexe pour la version “Hypercard”; mais ce lexique peut-être différent dans d’autres versions si nécessaire...).


:La génération d’un texte ne consiste donc en rien d’autre qu’en la transformation linéaire de l’ensemble des états non-finis en une chaîne d’états finis, c’est cette transformation qui constitue un parcours de graphes. En ce sens, il n’y a pas de niveau élémentaire de non-finitude : la génération consiste aussi bien en la juxtaposition de données comme : “le jour se lève” et “les enfants vont à l’école” que “[début-jour]” et “[description-ville]”... Tous les états intermédiaires sont possibles...


:GRAMSEM a pour fonction générale de contraindre le choix de la forme finie parmi l’ensemble des formes non-finies possibles. Par exemple (actuel Hypercard), la donnée “[71|m\_cheval]” contraint deux types de choix :


**::la valeur supérieur à 50 du descripteur implique le pluriel; le choix de la forme finie est donc “cheva + ux” dans “0(1)cheva|l ux”. (Noter que dans la version Hypercard, le seuil pluriel est 50; dans la version à venir, il serait bon de le porter à 100...)** ::la valeur 71 du descripteur implique “pluriel” du déterminant 21, c’est-à-dire : “tout son ,toute sa ,etc.”; les informations de la donnée non-finie “0(1)” impliquent non-élision “0” et masculin “1”, ce qui contraint à la possibilité (pluriel\*2) + (élision+1) + genre” du déterminant, choisi parmi la classe déterminants (cf. annexe 5), c’est-à-dire : “tous les “

:La forme finie résultante est donc : « tous les chevaux ».


## 2.2. Structure des données intermédiaires : ##

:On appelle « donnée intermédiaire », des données dont la classe ne comporte qu’un seul élément mais dont la forme n’est pas finie car elle contient encore des informations notamment paradigmatiques.


:Exemple :


:La classe de données non-finies “[1](a_amoureux.md)” est la suivante :


:1)affecti|f ve fs ves

:0)passionn|é ée és ées

:0)sexue|l lle ls lles

:0)tendr|e e es es

:0)vivan|t te ts tes

:[a\_absolu](a_absolu.md)

:[a\_amoureux](a_amoureux.md)

:[a\_attentif](a_attentif.md)

:[a\_conscient](a_conscient.md)

:[a\_humain](a_humain.md)

:[a\_lumineux](a_lumineux.md)


:elle contient des données non-finies comme “[a\_lumineux](a_lumineux.md)” et des données intermédiaires comme “0)passionn|é ée és ées”. Les données non-finies appellent une autre classe, les données intermédiaires ne réclament plus qu’un développement syntaxique. Ce développement syntaxique dépend :


**::d’informations extérieures à la donnée (cf. plus loin les transports d’informations)** ::d’informations internes spécifiques à la donnée et dépendant de la nature syntaxique de la donnée.

## 2.2.1. Descripteurs de données intermédiaires : ##

:Les descripteurs de données intermédiaires sont toujours structurés ainsi :




&lt;center&gt;

[[Image: Image 2]]


&lt;/center&gt;




:Dans cette structure :


**::« descripteur syntaxique » (DS) peut comporter de 0 à N éléments** ::« radical » (R) peut être vide ou comporter un élément
**::« terminaisons possibles » (TP) peut comporter de 0 à N éléments.**

:Exemples de données intermédiaires :


**::« puis » : DS=0, R=“puis”, TP=0; dans ce cas limite la donnée intermédiaire est déjà une donnée finie** ::« 0(2)souris|0 » : DS=“0(2)”, R=“souris”, TP=0, la donnée est finie mais donne des informations syntaxiques
**::« 1)élégan|t te ts tes » : DS=“1)”, R=“élégan”, TP=“t te ts tes”** ::« 1\arrêt|6 » : DS=“1\”, R=“arrêt”, TP=“6”, c’est-à-dire sous-ensemble 6 de la classe des terminaisons de verbes : “e es e ons ez ent ais ais ait ions iez aient ai as a âmes âtes èrent erai eras era erons erez eront erais erais erait erions eriez eraient e e e ions iez ent (6.aimer) ant er”

:Les DS dépendent de la sous-catégorie syntaxique des classes de données :


#### a - sous-catégorie substantif : ####

:marquage “m\_” des classes de données dans la version Hypercard




**::élision 0= pas d’élision (exemple : “hérisson”); 1=élision (exemple : “honneur”)** ::genre 1=masculin (exemple “hérisson”); 2=féminin (exemple : “houle”)

#### b - sous-catégorie adjectif : ####

:Marquage “a\_” des classes de données dans la version Hypercard.

<u>Dans une version définitive, il faudra décider si ce codage est maintenu ou enrichi en fonction des langues. Par exemple : « aa_ » pouvant signifier « adjectif anglais » ou au contraire être codé de façon numérique : « 11 » adjectif français, « 12 » adjectif anglais, etc.</u>





#### c - sous-catégorie verbe : ####

:Marquage “v\_” des classes de données dans la version Hypercard.




&lt;center&gt;

[[Image: Image 3]]


&lt;/center&gt;




**::élision 0=pas d’élision** ::élision 1=élision

:La sous-catégorie « syntagmes » comporte des termes de liaison très fréquents et non modifiables. Elle dispose d’un marqueur spécifique « # ». Cf.annexe 3 « syntagmes »


<u>Dans la version idéale (non réalisée dans Hypercard, mais implémentée dans Java), une donnée intermédiaire peut-être une chaîne, par exemple : "[01032|[1|m_jour] se levait <a href='66#.md'>66#</a> <a href='1#.md'>1#</a> [31|m_place 1]". Il s'agit d'une donnée intermédiaire puisqu'elle porte un descripteur contextuel qui n'apparaîtra pas dans la chaîne finale.</u>


## 2.3. Structure des classes de données : ##

:Toutes les données, finies ou non sont groupées en classes. Ces classes fonctionnent selon un principe de synonymie généralisée, c’est-à-dire qu’au regard de la sémantique du système, toute donnée d’une classe quelconque est, au niveau de cette classe, synonyme de toutes les autres. C’est principalement de cette façon que sont représentées les connaissances.


:Le système d’ensemble étant récursif, les données d’une classe peuvent être, elles-mêmes des classes.


:Les classes, ouvertes, peuvent comprendre de 1 à N données (N pouvant être théoriquement infini).


:Chaque donnée d’une classe peut-être définie par une « clef » qui contraint les choix du moteur de génération. Ces clefs rompent le principe de synonymie en introduisant une description spécifique de certaines des données d’une classe. Les clefs sont facultatives.


:Exemples de classes de données (empruntées à “Petit Prince” :


### 2.3.1. clef de la classe : “amitié” constituée de 4 données : ###

:003456| [0120010|v\_avoir] [=x|a\_vu] [3|caract3] ? [0300000|v\_demander 1] [1|caract1]; [21#](21#.md) [14#](14#.md) [69|carac3], [69|carac3], [69|carac3]... [52#](52#.md) [27#](27#.md) [3|caract3]... [0100001|v\_être] désespérant

:089000| [206#](206#.md), [0110000|v\_chercher] [3|caract3]; [0110000|v\_avoir] [102#](102#.md) [=x|a\_vu] [0900000|v\_passer] [58|carac3], [58|carac3], [58|carac3]... [52#](52#.md) [27#](27#.md) [3|caract3]... [77#](77#.md) [0110000|v\_attendre] [67#](67#.md)

:000000| [206#](206#.md), [0110000|v\_chercher] [3|caract3]; [0110000|v\_avoir] [102#](102#.md) [=x|a\_vu] [0900000|v\_passer] [58|carac3], [58|carac3], [58|carac3]... [52#](52#.md) [27#](27#.md) [3|caract3]... [77#](77#.md) [0110000|v\_attendre] [67#](67#.md)... [51|carac3] [47#](47#.md) [51|carac3] [1190000|v\_importer], [98#](98#.md) [0100100|v\_importer] [0100001|v\_être] [3|caract3]

:120980| [58|caract3], [58|caract3]... [90#](90#.md) [58|caract3], [52#](52#.md) [27#](27#.md) [3|caract3], [0100001|v\_être] [1#](1#.md) pleurer [19|m\_ennui]


### 2.3.2. clef de la classe : “a\_calme 2” constituée de 4 données : ###

:[a\_calme](a_calme.md)

:[a\_paisible](a_paisible.md)

:[a\_silencieux](a_silencieux.md)

:[a\_tranquille](a_tranquille.md)


:La formulation des clefs doit pouvoir être libre, ces clefs doivent pouvoir être simples ou complexes, exemple de clefs possibles : “anglais-pluie-ville”, “amitié”, “anglais-v\_think”, “français-m\_animal”, “anglais-rime-ing”, “espagnol-roman1-temps”, “1”, etc. Par contre le système doit refuser deux clefs identiques. Cette complexité permet de gérer les dictionnaires de langue ou les données spécifiques à telle ou telle œuvre particulière.


:Dans les cadres d’un usage « INTERNET » ou, éventuellement, « progiciels », ce point est particulièrement important car il permettrait de gérer la différence entre les données du moteur téléchargeables et non-modifiables et les données propres à telle ou telle application particulière. Cela peut également permettre de “marquer” un droit de propriété (« copyright » ou « identificateur ») sur tel ou tel ensemble de données. <u>Il me semble donc que ce point est à réfléchir tout particulièrement.</u>


:Trois types de développements d’une classe existent pour l’instant :


**::développement aléatoire : le moteur de génération choisit l’une quelconque des données de la classe, par exemple “[a\_silencieux](a_silencieux.md)” dans la classe “a\_calme 2”;** ::développement contraint : le moteur de génération choisit une donnée spécifique de la classe. Par exemples, dans la classe “#”, le nombre précédent la clef de classe indique quelle donnée de cette classe est nécessaire, [51#](51#.md) contraint le moteur de génération à prendre l’enregistrement 51 de cette classe (“car”... Notons au passage que cette classe, telle quelle est — cf. annexe 2 — est, pour des raisons “historiques”, assez mal faite et sera revue de fond en comble pour les versions à développer). C’est également la méthode utilisée pour la génération des verbes. Ces types de contraintes constituent la “Rhétorique” du générateur (cf. ce point plus loin). Dans la version “Hypercard” ceci a été fait de façon un peu “bricoleuse”, il est nécessaire de partir sur des bases plus saines.
**::développement calculé à partir des descripteurs : pour cela, il est indispensable d’étendre la possibilité de description à toute classe en dotant toute classe d’un “descripteur contextuel de classe”; dans ce cas, le choix aléatoire ne serait plus qu’un usage défini d’un ensemble d’usages. Dans l’idéal, ce descripteur contextuel pourrait être incrémental.**

## 2.4. Structure idéale d’une donnée : ##

:Dans l’idéal, une donnée autre qu’intermédiaire devrait être structurée ainsi :


**::début de donnée dans la chaîne** ::descripteur conceptuel de classe de donnée : nature et longueur variable (dans une version simplifiée, ce descripteur peut être absent ou ignoré, les classes de données jouant alors un rôle de descripteur de base)
**::marqueur** ::clef de la classe de données : nature et longueur variable
**::marqueur** ::descripteur paradigmatique éventuel de la donnée : nature et longueur variable
**::fin de donnée dans la chaîne**

:Exemple :




:<u>L'ordre des trois composantes du descripteur n'est qu'indicatif : si nécessaire, il peut être autre (dans l’Hypercard actuel, l’ordre est “descripteur paradigmatique” + “clef” et il n’y a pas de descripteur contextuel).</u> Cette structure doit rester récursive : une donnée non-finie peut toujours être constituée de données non-finies, le développement ne cesse que lorsque le moteur de génération ne rencontre plus que des données finies.


:Tous les descripteurs, sauf bien entendu la clef de classe, peuvent être vides, même si cela produit des effets pervers. Par exemple “[v\_aimer](v_aimer.md)” donne actuellement “aim” et “[0420000|v\_aimer]” donne “aimeras”.


:Une donnée à développer peut donc être : "[chercher-pluie]".


## 2.5. Les données comme graphes : ##

:Les données, quel que soit leur niveau, ont la même structure. Les niveaux de données ne différent que par leurs descripteurs.


:On distingue :


**::Les données « texte »** ::Les données « intermédiaires »
**::Les données « terminales »**

:Idéalement une donnée est un graphe, c’est-à-dire un ensemble de liens entre classes :


:[th-amour] [th-faire] [th-bonheur]


:signifie en effet qu’il y a une relation structurelle entre ces trois classes et que cette relation intervient dans l’ordre «[th-amour]->[th-faire]->[th-bonheur]». A chaque position du graphe peut donc être rattaché un autre graphe :


:[th-bonheur] peut se réécrire [th-vie] [th-joie] [th-soleil], soit, une fois développé :


:[th-amour] [th-faire] [[th-vie] [th-joie] [th-soleil] ]


:Les contraintes portant sur un élément du graphe peuvent donc, sauf spécification contraire, se propager à tous les éléments de ce graphe. Par exemple,


:[th-amour] [th-faire] [10|th-bonheur]


:est équivalent à :


:[th-amour] [th-faire] [[10|th-vie] [10|th-joie] [10|th-soleil] ]


## 2.6. Structuration des dictionnaires de données : ##

:Le développement des données est une règle universelle, indépendante de la nature même des données à développer. Cette situation permet de concevoir une hiérarchie de dictionnaire riche utilisant les descripteurs de classes des données.


:Par exemple, “v\_chanter” indique que la chaîne constituant cette donnée doit être considérée comme un verbe et “a\_gentil” qu’elle doit l’être comme un adjectif. Ce marquage permet, entre autres choses de distinguer en français “v\_manger” et “m\_manger”.


:Les marquages de classes de données dans le dictionnaire sont pour l’instant les suivantes <u>étant donné que ces marquages sont arbitraires et ne modifient pas le fonctionnement profond du MOTEUR, ils peuvent être modifiés ou enrichis suivant les besoins</u> :


{|
|:niveau 0
|:niveau 1
|:niveau 2
|niveau 3
|-
|:a_: adjectif
|:a_... x : synonymes adjectifs
|:di : dictionnaire particulier
|a : adjectif
|-
|:m_: substantif
|:m_. x : synonymes substantifs
|:th : thème spécifique
|s : substantif
|-
|:v_: verbe
|:v_... x : synonymes verbes
|:sy : locution syntaxique
|v : verbe
|-
|:s_: adverbe
|:s_... x : synonymes adverbes
|:rc : représentation des connaissances
|l : locution
|}
:Les descripteurs des deux dernières colonnes peuvent être ajoutés. Ainsi “rcl-dieux” signifie “dictionnaire de locutions représentant des connaissances particulières sur des dieux”.


:Cette liste de marqueurs de descripteurs n’est pas finie : elle doit rester ouverte en fonction de besoins ultérieurs. Le module central doit accepter cette ouverture et l’intégrer au besoin sans difficultés (liste de descripteurs externe au module et intégrable par simple chargement).


## 2.7. Descripteurs contextuels de classes (ROMAN) : ##

:Dans les actuelles versions Hypercard, les descripteurs contextuels ne sont qu’à l’état d’ébauche. Par contre ils étaient la base des générateurs des anciens logiciels ROMAN. Le projet est donc de mettre simultanément en œuvre les capacités de chacune de ces approches. Les descripteurs contextuels sont, en terme de sémantique, équivalents à des classes. Ils peuvent donc être vides.


:Leur principe est le suivant : décrire chaque donnée en terme de “concepts de contextes” de façon que, dans une situation donnée, le moteur de génération soit à même de choisir la solution la plus adéquate.


:Cf. à ce sujet une présentation sommaire, dans un autre contexte, de cette approche dans mon livre : « Hypertextes, hypermédias, hyperdocuments, Eyrolles, 1990.


## 2.7.1. Un tout petit peu de théorie : ##

:La génération automatique de texte fonctionne généralement sur une approche pseudo-graphes-conceptuels.

:Cette approche, à un niveau de généralité élevée, consiste à dire que dans un contexte syntaxique donné, un certain nombre de primitives peuvent intervenir dépendantes de ce contexte. Par exemple, un verbe comme “aimer” transporte un contexte du type “agent” - “objet” :




:Qui peut se traduire par “Quelqu’un aime quelque chose”. Ce premier contexte dépend donc du noyau du graphe, ici le verbe “aimer”. Il est donc à base linguistique.


:A partir de là, il s’agit de décrire les “objets” du “monde linguistique” en terme de structure de concepts, c’est-à-dire de primitives assez générales pour pouvoir être réutilisées dans des contextes divers de façon à permettre des additions de graphes. Ainsi, si “homme” est un objet possible et si “homme” transporte le graphe suivant :




:disant qu’un homme est un objet possible défini par un concept “nom” pouvant prendre la forme “Pierre” et un concept “possédant” pouvant prendre les formes “visage, regard et intelligence”, alors un nouveau graphe peut-être constitué par addition :




:Graphe qui permet “d’imaginer” des séquences comme : “Quelqu’un aime Pierre” ou “quelqu’un aime le visage de quelqu’un” ou “quelqu’un aime l’intelligence de Pierre”, etc.


:Cette approche conceptuelle est parfaitement juste en ce sens qu’elle tente de lier de façon indiscernable la représentation du monde et la formulation linguistique par laquelle cette représentation passe.


:Malheureusement, trop “optimiste”, elle sombre sur les “Charybde et Scylla” de la linguistique computationnelle :


**::la représentation du monde est infinie, on ne peut en faire une description en extension et toute description en compréhension court le risque d’être incomplète : un homme “possède” un regard, une intelligence, etc. mais aussi des cellules, des atomes, un ADN, etc. chacun des objets qui constituent l’homme peut, en soi, constituer un univers et les différences entre ces objets en contexte sont au moins aussi importantes que leurs ressemblances : l’intelligence de Pierre n’est pas celle de Jacques... On en reste donc soit à un niveau de généralité tel qu’il s’avère vite inexploitable, surtout en littérature où l’essence même du littéraire exige une recherche des spécificités plutôt que celle des topicités.** ::par nécessité d’adaptation à cet infini du monde, la langue est naturellement imprécise, floue et contextuelle (que serait une langue dans laquelle le mot “chaise” désignerait une chaise précise parmi l’ensemble des chaises possibles; seuls les langages techniques tendent à cela avec l’inflation que l’on sait : environ 500 000 termes pour le seul vocabulaire de la métallurgie...). Dans ce cadre, un “homme” n’est jamais un homme, mais toutes les possibilités de signification de ce terme restreintes par le contexte d’usage. Une conséquence en est que “dire quelque chose” est toujours un ensemble de possibilités ouvertes et ouvertes à l’interprétation. Pour exprimer le graphe :



:La langue dispose d’une panoplie d’expressions impressionnante : “Pierre a des yeux d’acier, Pierre a les yeux bleus, les yeux de Pierre sont bleus, les yeux de Pierre sont d’azur, les yeux de Pierre comme un lac bleu, le bleu des yeux de Pierre, etc.”. C’est ce mécanisme qui fonde la créativité linguistique. Or la créativité linguistique est à la base même de l’écriture. Sans compter que l’écriture joue plus sur l’imprécision — l’ouverture — que sur son contraire.


### 2.7.2. Position théorique du moteur de génération : ###

:GRAMSEM vise à prendre tous ces impératifs en compte :


**::il utilise une approche pseudo-graphe-conceptuel en ce sens que chaque génération de texte est un parcours de graphes pré-constitués ou calculés dont les primitives sont constitués par des concepts définissant des classes de données (les clefs des classes),** ::il prend acte de la variabilité linguistique en refusant l’enfermement dans un niveau prédéterminé de primitives et en se donnant des niveaux variables d’éléments dans les structures de graphes : c’est en ce sens qu’il s’appuie sur une grammaire sémantique.
**::il cherche à définir une modalité de fonctionnement indépendant des langues et basé essentiellement sur les représentations de connaissances.**

:Par exemple dans :




:la “qualité” qui définit la “composante météorologique” du paysage peut-être réalisée en surface aussi bien par :


**::il pleut** ::la pluie tombe
**::une petite pluie glaciale zèbre l’air** ::les aiguilles d’acier d’une fine pluie glaciale coupent l’atmosphère de zébrures
**::de lourdes gouttes s’abattent sur le sol dans un bruit de succion**

:chacune de ces phrases pouvant bien entendu être elle-même le résultat du développement d’un graphe conceptuel :




:mais, à moins d’avoir une représentation exhaustive des connaissances et des fictions du monde, chaque nouvel “avatar” demande des graphes spécifiques; de plus, même si cette condition est remplie, la variabilité linguistiques des chaînes de surface est quasi-impossible à atteindre — il suffit pour s’en rendre compte d’imaginer les construction nécessaires pour obtenir les séquences “d” et “e” ci-dessus.


:Le choix fait est donc de constituer des classes conceptuelles dont le niveau de développement est linguistiquement variable, certaines données pouvant être d’un niveau très élémentaire, d’autres d’un niveau très élaboré.


:Même si, sur le plan d’une certaine « pureté » théorique, ce choix est critiquable, il est assez efficace dans une approche pragmatique orientée vers la production car, notamment, il déporte l’essentiel des problématiques stylistiques sur les classes de données.


### 2.7.3. Utilité des descripteurs contextuels : ###

:Ainsi un créateur peut très bien décider de n’utiliser ce programme qu’à gérer des fragments de phrases déjà développés :


**::une jeune fille se promène dans la rue ensoleillée** ::un jeune homme passe
**::la boulangère regarde par sa fenêtre** ::un enfant sort de l’école

:Cet ensemble donne déjà un certain nombre de textes possibles. Dans ce cas-là, la créativité dépend strictement d’une combinatoire prenant en compte le rapport entre le nombre de données disponibles et la longueur des textes recherchés.


:Les « concepts » — c’est-à-dire les abstractions qui étiquettent les ensembles que constituent les classes — jouent un rôle de tri de premier niveau qui peut pourtant être parfaitement efficace dans une finalité donnée.


:Pourtant, souvent, la maîtrise de ce seul niveau entraîne des effets pervers, notamment lorsque les données constituant les classes sont nombreuses. Soient, par exemple, les données suivantes empruntées à deux classes dont les concepts (les clefs) sont respectivement “paysage” et “temps ensoleillé” :


:A.Paysage :


**::.......................................** ::la ville est belle
**::la lumière est éclatante** ::les passants ont l’air heureux
**::la lumière est belle** ::la transparence de l’air est tamisée par les fines gouttes d’eau de la pluie
**::........................................**

:B. Temps ensoleillé :


**::........................................** ::il fait très beau
**::la lumière est éblouissante** ::le soleil coupe au couteau de grandes tranches d’ombre et de lumière
**::le soleil plaque l’ombre sur les trottoirs** ::.........................................

:un texte définit comme : “[paysage](paysage.md) [ensoleillé](temps.md)” ou “[ensoleillé](temps.md) [paysage](paysage.md)” peut construire une juxtaposition de n’importe quelle donnée de la classe A avec n’importe quelle donnée de la classe B, or au moins la donnée Ae n’est pas vraiment compatible — dans une logique de monde réaliste — avec les données de B. Cette incompatibilité revient en fait à décider que le concept “paysage” est un concept de trop haut niveau et qu’il devrait au moins comporter les sous-concepts “beau temps” et “pluie” mais aussi, pourquoi pas, les concepts : “ville, campagne, saison, température, heure du jour, etc.” bref à réintroduire, comme autant de sous-classes, la complexité des connaissances sur le monde envisagé.


:Le rôle des descripteurs contextuels est de réaliser cela de façon simple... Dans :


:A.Paysage :


:On peut remarquer que certaines données ne sont pas spécifiques à la ville alors que d’autres le sont, que certaines ne sont pas sensibles à l’heure du jour, etc. Il s’agit alors, à l’intérieur d’une classe donnée de réaliser des sous-ensembles locaux indiqués par des descripteurs attachés à chaque donnée. Par exemple, si 0 est une valeur non marquée et 1=“ville”, le descripteur de ces données pourrait être :


**::« 1|la ville est belle »** ::« 0|la lumière est éclatante »
**::« 1|les passants ont l’air heureux »** ::« 0|la lumière est belle »
**::« 0|la transparence de l’air est tamisée par les fines gouttes d’eau de la pluie »**

:L’avantage est alors que ces données sont disponibles à des usages plus ouverts du « paysag »” : campagne, montagne, mer, etc… L’inconvénient est encore l’impossibilité à codifier l’exhaustivité des aspects du monde.


:Un descripteur contextuel a donc pour effet de créer, à l’intérieur d’un ensemble conceptuel donné, des sous-ensembles conceptuels dépendants. la richesse de ces descripteurs contextuels peut être très grande : il suffit d’associer à chaque concept une représentation sous-conceptuelle fine. Si par exemple “soleil”=1 et “pluie”=2, le descripteur peut devenir :


**::« 10|la ville est belle »** ::« 01|la lumière est éclatante »
**::« 10|les passants ont l’air heureux »** ::« 00|la lumière est belle »
**::« 02|la transparence de l’air est tamisée par les fines gouttes d’eau de la pluie »**

:Chaque donnée est accessible à une grammaire sémantique.


### 2.7.4. Fonctionnement des descripteurs contextuels : ###

:Pour que GRAMSEM fonctionne de façon efficace, cela suppose que MOTEUR sache ce qu’il cherche... Plusieurs cas sont possibles :


**::choix contraint : une donnée extraite contient une indication sur la description recherchée. Exemple, le moteur rencontre à un moment T donné la donnée non-finie suivante : “aujourd’hui les rues sont élégantes, [11|paysage]...”. Le moteur de génération sait qu’il cherche des données compatibles avec un “paysage” ensoleillé (données a, b, c ou d). Il utilise le descripteur contextuel comme filtre. Si les données sont classées par ordre alphabétique dans la classe, cette recherche est assez facile :**

**::« 00|la lumière est belle »** ::« 01|la lumière est éclatante »
**::« 02|la transparence de l’air est tamisée par les fines gouttes d’eau de la pluie »** ::« 10|la ville est belle »
**::« 10|les passants ont l’air heureux »**

**::choix calculé : la donnée extraite initiale est en attente d’informations provenant de la nouvelle donnée. Exemple, le moteur rencontre à un moment T donné la donnée non-finie suivante : « les rues sont très animées, [00|paysage], [00|paysage]... ». Le moteur de génération n’a d’abord aucune idée préconçue sur le type de paysage accepté, tout est possible lors de la première rencontre du concept « paysage », mais la deuxième rencontre de « paysage » est contrainte par cette première. Si le premier choix donne pluie, alors le deuxième choix doit aussi être de la pluie. Si la donnée de départ est : « les rues sont très animées, [00|paysage], [00|paysage] [00|regard-amoureux]... », le concepteur peut décider que l’information se transmet à « regard amoureux », soit — situation plus simple à programmer — que « regard amoureux » est insensible à ce type d’information et obéit à d’autres contraintes contextuelles.**

:Il est donc nécessaire de pouvoir déclarer que de 1 à N classes (c0-cN) sont sensibles (1) ou non (0) aux descripteurs conceptuels de telle ou telle classe (DC1-DCN) :



{|
|

|:c1
|:c2
|:c3
|:c4
|:c5
|:c6
|:c7
|-
|DC1
|:0
|:0
|:0
|:0
|:1
|:0
|:0
|-
|DC2
|:1
|:1
|:0
|:0
|:0
|:0
|:0
|-
|DC3
|:0
|:0
|:0
|:0
|:1
|:0
|:0
|-
|DC4
|:0
|:0
|:1
|:0
|:0
|:0
|:1
|}
:Le plus simple étant évidemment de supposer que, sauf déclaration spécifique, une classe donnée n’est sensible à aucun descripteur contextuel.


:Ce système n’est que partiellement implémenté en Java et il semble que la méthode des classes permette les mêmes résultats à un coût moindre (descripteurs vides). Il est peut-être inutile de l’implémenter.


## 2.7.5. Calculs dans les descripteurs conceptuels : ##

:Pour être efficace, le calcul dans les descripteurs contextuels doit être dynamique. En ce sens, il n’est pas réalisé une fois pour toutes mais au fur et à mesure de la génération du texte.


:Cela suppose que soit gardée une mémoire des informations contextuelles.


:Cela suppose également qu’existe une valeur neutre (ici “0” signifiant “non concerné par cette valeur du concept”)


:Si, lors du développement, le descripteur contextuel d’une classe comme “[bonheur](bonheur.md)” est “001”, toute nouvelle donnée compatible avec “[bonheur](bonheur.md)” est comparée aux valeurs de ce descripteur contextuel. Cette dynamicité peut-être représentée ainsi :


{|
|:valeur mémoire initiale
|:0000
|-
|:Première donnée
|0010
|-
|:valeur mémoire résultante
|0010
|-
|:Deuxième donnée
|1000
|-
|:valeur mémoire résultante
|1010
|-
|:Troisième donnée
|0000
|-
|:valeur mémoire résultante
|1010
|-
|:Quatrième donnée
|0200
|-
|:valeur mémoire résultante
|1210
|-
|:Cinquième donnée
|1203
|-
|:valeur mémoire résultante
|1213
|-
|:...
|...
|}
:Dans ROMAN, existaient de nombreuses règles différentes gérant le calcul des descripteurs contextuels. L’expérience montre que, dans le système Hypercard, une règle peut suffire, celle d’addition qui se formule ainsi : “la valeur mémoire résultante équivaut à la prise en compte de toutes les valeurs non neutres des données sélectionnées.”


:Le fonctionnement de cette règle peut être représenté ainsi (“...” indique le rejet de la donnée correspondante) :


{|
|:valeur mémoire initiale
|:00000
|

|

|

|

|-
|:Première donnée
|:01040
|

|

|

|

|-
|:valeur mémoire résultante
|:01040
|

|

|

|

|-
|:Données proposées
|:02000
|:00100
|:10005
|

|

|-
|:valeur mémoire résultante
|:...
|:01140
|:11045
|

|

|-
|:Données proposées
|:...
|:01300
|:00005
|

|

|-
|:valeur mémoire résultante
|:...
|:...
|:11045
|

|

|-
|:Données proposées
|:...
|:...
|:10005
|:10000
|

|-
|:valeur mémoire résultante
|:...
|:...
|:11045
|:11045
|

|-
|:Données proposées
|:...
|:...
|:01040
|:11000
|20000
|-
|:valeur mémoire résultante
|:...
|:...
|:11045
|:11045
|...
|-
|:Données proposées
|:...
|:...
|:01000
|:00300
|...
|-
|:valeur mémoire résultante
|:...
|:...
|:11045
|:11345
|...
|-
|:Données proposées
|:...
|:...
|:11145
|:00300
|...
|-
|:valeur mémoire résultante
|:...
|:...
|:11145
|:11345
|...
|-
|:Données proposées
|:...
|:...
|:11140
|:00510
|...
|-
|:valeur mémoire résultante
|:...
|:...
|:11145
|:...
|...
|}
:La sélection par “descripteur contextuel” revient donc au parcours d’un graphe à constitution dynamique de parcours.




:Le texte produit par ce parcours n’est qu’un des textes possibles... Si le nombre de données disponibles est important, le résultat en termes de textes est imprévisible bien que toujours sémantiquement cohérent.


:Au bout d’un certain nombre de sélections, la valeur résultante de la mémoire est saturée (ci-dessus “11145” ou “11345” et seules les données présentant ce descripteur sont acceptables : le générateur devient bègue, il doit donc arrêter la recherche de données de ce contexte... dans ROMAN, diverses règles permettaient de vider une partie des valeurs de la mémoire. Il ne semble pas utile, pour l’instant, de les implémenter).


# 3. Rhétorique : #

:Les fonctions «rhétoriques» ont pour but de déterminer la «forme» des textes générés. Par forme, il faut entendre :


**::le type de relations entre les pages** ::la forme d’affichage des pages
**::la sélection de choix de formes dans les «groupes»** ::l’acceptation ou le refus de reprise (répétition) des données
**::la longueur des textes résultant** ::la langue utilisée pour le texte
**::le nombre de classes « carac » utiles (cf.plus bas)** ::etc.

## 3.1. Rhétorique «générale» : ##

:Si l'on appelle «texte» la chaîne de caractère produite par une demande de génération donnée et «œuvre» l'ensemble des textes produits durant l'utilisation d'un moteur de génération donné, la rhétorique est le niveau qui indique le mode de constitution général du texte et de l'œuvre à produire. Elle doit pouvoir paramétrer l'aspect général de l'ensemble des textes constituant une œuvre, par exemple, à un moment T donné, décider d'ignorer telle ou telle classe.


:Par exemple dans «Hommage à Jean Tardieu» qui produit des textes comme :


:«je m'offre à chacune

:la vie est si étale la joie

:comment faire pour être heureux

:nous n'irons plus

:au bois la lumière tremble

:de reflets vigueur mâle

:du jour froissement

:soyeux des oiseaux arbres

:infranchissables je ne

:sais que faire le vent

:se lamente attente je descends

:passe ne dis rien

:résiste te cherche»


:Ce générateur ne comporte qu'une seule classe constituée de données du type :


:je m'offre à chacune

:la lumière tremble

:ta peau boit le soleil

:...


:Le descripteur rhétorique est vide : le choix des données est aléatoire, il peut donc reprendre théoriquement plusieurs fois la même donnée dans un poème.


:Par contre dans «Un Roman inachevé», 40 classes sont désignées comme fondatrices; le descripteur rhétorique a deux possibilités :


**::choisir aléatoirement entre ces 40 classes et dans la classe choisie choisir aléatoirement parmi les données non encore extraites pour le paragraphe en cours,** ::choisir systématiquement dans une classe donnée et dans cette classe choisir aléatoirement parmi les données non encore extraites pour le paragraphe en cours.

:Les règles rhétoriques indiquent donc quelles sont les modalités d'extraction des classes et à l'intérieur des classes. Elles doivent pouvoir être accessibles au lecteur. Elles indiquent aussi les modalités d’affichage.


:Par exemple, dans «Prière de meurtre» ou «Petit Prince», un curseur laisse au lecteur le droit de choisir les classes à partir duquel il veut générer son texte.


:Dans l'idéal, les règles rhétoriques doivent pouvoir :


**::désigner la ou les classes à partir desquelles les textes sont générés (description donnée dans le «champ moteur» de la dernière version Hypercard).** ::dire quelle est, pour un texte, ou un ensemble de texte donné, la modalité d'extraction des données dans les classes :
**::aléatoire** ::conditionnelle
**::non reprise** ::répétée suivant quel rythme
**::ordonnée suivant quel ordre** ::dire quelle est la longueur du texte à produire
**::en longueur de chaîne (ROMAN arrête d'extraire des données dès que le texte en cours dépasse une longueur paramétrable, par exemple 800 caractères)** ::dès que le générateur rencontre un indicateur de fin de chaîne («FF» dans ROMAN)
**::intervenir sur un certain niveau de découpage, par exemple retour à la ligne pour la «poésie» ou les «dialogues»** ::choisir la (ou les langues) acceptée

:Les règles rhétoriques sont externes aux données : elles paramètrent le moteur de génération lui-même. On peut prévoir qu'elles seront amenées à évoluer de façon plus riche qu'actuellement notamment si les outils développés sont amenés à servir de progiciel.


:Par exemple, dans «Les tentations de Tantale» qui génère des sonnets, ces règles rhétoriques définissent :


**::la notion de strophe (cf. plus loin la forme poésie)** ::la notion de refrain (cf. plus loin carac)
<u>la notion de rythme (pas abordé ici, à venir plus tard éventuellement)</u>

:D’autres marquages doivent pouvoir intervenir : pour cette raison, le descripteur rhétorique n’a pas à être arbitrairement limité en taille.


## 3.2. Les classes de type «carac» et «caract» {{fn Le fonctionnement de ces classes n’est pas implémenté dans Java et doit absolument l’être.}}: ##

:Pour produire des textes «acceptables», la rhétorique s'appuie sur un système de variables. En effet, dans la génération d'un texte, l'ensemble des variables ne joue pas le même rôle. On peut distinguer :


**::des variables «locales» : ce sont celles qui permettent de passer d'une donnée non-finie à une donnée finie. Par exemple : «[prénomh]» va amener une donnée finie comme «Jean»; un nouvel appel à «[prénomh]» pouvant alors donner «Pierre». Ainsi, à partir d'une donnée non-finie comme : «[prénomh] [0100000|v\_regarder 1] [prénomh]», la chaîne de sortie peut être : «Jean regarde Pierre» ou «Jean examine Jean» sans que le moteur de génération contrôle ces possibles.** ::des variables de texte (suivant la définition donnée plus haut à «texte». Par exemple, si «Jean» est le héros de ce texte, il est bon qu'il le reste tout le long du texte, ce qui ne peut pas être le cas avec une variable locale. Il faut donc que le moteur de génération attribue une valeur fixe particulière à une, ou plusieurs, variable de texte. Dans la version Hypercard, cela se passe au niveau des variables «carac» et «caract» : chaque fois qu'une génération de texte est lancée, le moteur de génération extrait des classes de données «caracx» une valeur attribuée à la variable «caractx» correspondante («caract1» correspond à «carac1», «caract2» à «carac2» {{fn Bien entendu, rien n’interdit de les désigner d’un autre nom car ce qui importe est leur mode de fonctionnement.
}}, etc.). Par exemple :

:Si carac1=«Jean, Pierre,Léon,Marcel,etc.»; caract1 peut être affecté de la valeur «Léon». Ainsi : «[caract1](caract1.md) [0100000|v\_regarder 1] [carac1](carac1.md); [caract1](caract1.md) [1100000|v\_aimer 1] [carac1](carac1.md)...» donnera une chaîne terminale comme : «Léon observe Pierre; Léon n'aime pas Marcel...»


:Dans Hypercard, les classes de type carac sont prédéterminées. Dans une version plus évoluée, il serait bon que ces affectations de classe soient paramétrables par les auteurs qui sont ceux à pouvoir décider du nombre de variables de ce type dont ils ont besoin.


:Dans Hypercard, le nombre de classes «carac...» est inscrit dans le moteur de génération. Dans une version plus évoluée, ce nombre doit être ouvert et donc paramétrable à partir notamment du descripteur de texte.


:Il y a plusieurs façons de gérer les relations entre carac et caract (dépendant des stratégies de continuité-changement dans un texte donné)


**::des variables de type «œuvre» : ces variables sont gérées par la simple constitution de classes de données particulières à une œuvre donnée. Par exemple, dans «Prière de meurtre», roman policier qui exige un certain nombre de héros fixes, «[héros7-h]» ne désigne qu'un seul personnage sous diverses formes : «Hamid Kharamidov, Kharamidov, Khamid Khan Kharamidov, Hamid Khan Kharamidov...» Dans ce cas, la rhétorique n'a pas à se soucier de la valeur réelle de la variable et une variable de ce type pourrait être : «Paris, la ville aux cent visages.»** ::certaines variables de type carac peuvent référer à des événements, par exemple [matin](matin.md). dans ce cas, deux possibilités se présentent :
**::il n’y a pas d’autre indication et chaque recours à «carac» envoie dans «caract» une instanciation aléatoire parmi celles possibles dans [matin](matin.md)** ::l’instanciation dans [matin](matin.md) se fait une fois et une seule. Par exemple, si [matin](matin.md) --> «le matin», «à l’aube», «à l’aurore», «à huit heures du matin», etc. «carac» prend, en début de séquence de génération, une seule de ces valeurs qui sera transmise ensuite normalement à «caract». Dans ce cas, l’événement est marqué «[matin](matin.md)]» avec le signe «]]» en fin d’événement. Ceci permet de jouer sur plusieurs niveaux de refrains.

## 3.3. Relations entre pages : ##

:Les relations entre pages font partie de la structure des événements, elles peuvent se construire de deux façons :


**::aléatoire : chaque page est indépendante : l’œuvre créée est le résultat de l’ensemble des pages enregistrées, le «lecteur» est responsable d’une éventuelle mise en ordre en décidant lui-même que la page X... doit être lue avant la page Z...** ::pré-définie : un événement générique contrôle l’ordre de génération des pages. Cet événement est défini par l’auteur qui peut par exemple décider qu’une œuvre est constituée de la suite [début-d’œuvre] [milieu-d’œuvre] [fin-d’œuvre], chacun des éléments de cette suite constituant autant d’autres événements génériques.

## 3.4. Forme des pages : ##

:La «forme» des pages est essentiellement un problème d’affichage pour la lecture. Le calcul est donc constitué en fin de chaîne pour affichage. Pour l’essentiel, cette «forme» recouvre deux types principaux d’affichage :


**::prose** ::poésie

:Les types d’affichage sont donnés par les deux dernières valeurs du descripteur de texte (position numérique 10 et 11) : «=000000000<u>00</u>$»


### 3.4.1 La prose : ###

#### 3.4.1.1. Arrêt d’une page prose : ####

:Dans la prose, la forme principale est la juxtaposition : chaque événement provoque la génération d’un texte ajouté au texte précédent. Par exemple : «Le ciel est beau.» et «Les oiseaux chantent» sont juxtaposés pour produire «Le ciel est beau. Les oiseaux chantent.». Cette juxtaposition pose un problème d’arrêt. En effet, la génération peut toujours théoriquement continuer par adjonction d’un nouvel événement et ceci jusqu’à l’infini. L’arrêt est donc contrôlé de deux façons :


**::arrêt non défini : une valeur est fixée par l’auteur à cet arrêt, par exemple 1000 caractères : dès que la chaîne générée a développé un événement au-delà de 1000 caractères, elle s’arrête. par exemple si [description-lieu] [météo] [heure](heure.md) dépasse 1000 caractères, il n’y a plus recherche d’un autre événement.**<u>(A développer : cette longueur peut-être fixée dans le descripteur de texte).</u>
**::arrêt défini : un marqueur en fin d’événement «FF», provoque l’arrêt de la génération. Par exemple : [description-lieu] [météo] [heure](heure.md)FF; la génération s’arrête après le développement de l’événement [heure](heure.md). (A développer, cet arrêt forcé doit être « compatible » avec l’arrêt indiqué dans le descripteur de texte).** ::<u>Les deux solutions doivent pouvoir être compatibles</u>.

:Dans ce cas, les valeurs concernées du descripteur sont «00». Par exemple, un descripteur «=000000000<u>00</u>$» amène à un découpage de type «prose».


#### 3.4.1.2. Découpage d’une page prose : ####

:Une page prose est normalement un bloc continu de texte sauf en cas de dialogue où il faut gérer des retours à la ligne. Cette gestion peut être faite soit par information venant de la donnée intermédiaire — contrainte aval } (ex. cas des dialogues), soit par information venant des données textes —contrainte amont. Les événements «dialogue» commencent ainsi par les signes «— ». La présence de ces signes indique donc la nécessité d’aller à la ligne avant eux. Par exemple, si l’événement contient : «— “Ne dis rien !”» et que l’événement précédent soit : «Il l’interrompit avec violence :», l’affichage sera le suivant :


:«...Il l’interrompit avec violence :

:— “Ne dis rien !”»


:Un autre cas de retour à la ligne, est la présence dans la chaîne développée du signe «%». Par exemple : «Elle lui parlait toujours avec violence.%%Lui préférait la tranquillité...» amène l’affichage :


:«Elle lui parlait toujours avec violence.


:Lui préférait la tranquillité...”


:Et : «Elle lui parlait toujours avec violence.%Lui préférait la tranquillité...”


:amène :


:«Elle lui parlait toujours avec violence.

:Lui préférait la tranquillité...”


:NB. Il y a autant de retour à la ligne que de marqueur : [matin](matin.md)%%[mer](mer.md) [chaleur](chaleur.md)FF entraîne un double retour à la ligne après l’événement matin et [matin](matin.md)%[mer](mer.md)%[chaleur](chaleur.md)FF entraîne un retour à la ligne après [mer](mer.md) quel que soit par ailleurs le découpage en vers-défini.


#### 3.4.1.3. Répétitions dans un texte : ####

:Il peut être décidé qu’un texte contient ou non des répétitions d’éléments. Cette décision est contrôlé par la valeur 9 du descripteur de texte : «=00000000<u>0</u>00$»


:La valeur 0 (=00000000<u>0</u>00$) indique que le texte peut contenir des répétitions, la valeur 1 (=00000000<u>1</u>00$) qu’il en admet peu. Cette valeur de répétition est progressive depuis 0 — répétitions possibles — jusqu’à 9, le moins de répétitions possibles.


:Pour éviter ces répétitions, le générateur explore plusieurs fois un champ de données et travaille donc en boucle suivant la formule suivante : Nbre\_boucles = partie entière de 100 que multiplie valeur de répétition divisé par le nombre de données du champ exploré/


### 3.4.2. La poésie : ###

:La poésie se caractérise formellement par une forme «vers», c’est-à-dire un contrôle des retours à la ligne. On distingue quatre formes poésie :


**::poésie en «vers-régulier»** ::poésie en «vers-libre»
**::poésie en «vers-défini»** ::poésie en «vers définis centrés»

:Ces choix sont pré-définis dans le descripteur contextuel de l’événement générique «poésie». En cas de non définition, la forme adoptée est celle de la prose. La poésie est donc une forme marquée par rapport à la forme prose.


:Les deux derniers caractères du descripteur contextuel de l’événement générique contraignent le choix de la forme poésie :


**::«01» poésie en vers-régulier** ::«02» poésie en vers-défini
**::«XX» poésie en vers-libre** ::«03» poésie en «vers définis centrés»

#### 3.4.2.1. Poésie en vers régulier : ####

:La procédure d’affichage étant terminale à la génération, la longueur totale de la chaîne générée (LT) est connue au moment de la mise en page. Le découpage en vers régulier se fait donc de la façon suivante : INT (LT / nombre de lignes possibles d’affichage (NL)) = longueur moyenne du vers (LV). Par exemple, supposons que LT = 834 et NL= 24 --> LV = 34. Le découpage se fait donc en prenant comme base le premier blanc de la chaîne après LV. Par exemple, pour une chaîne comme : «Le ciel est par-dessus le toit si bleu si calme pas un bruit pas un son tout semble si paisible...», le premier vers sera : «Le ciel est par-dessus le toit si» et le second «bleu si calme pas un bruit pas un son», etc.


#### 3.4.2.2. Poésie en vers-défini : ####

:Un vers défini est défini par un marqueur inséré dans la chaîne de l’événement générique du poème. Dans hypercard, ce marqueur est «%». Il indique un retour forcé à la ligne quelle que soit la longueur de la chaîne générée précédemment. Par exemple, si l’événement générique est : [matin](matin.md)%[mer](mer.md) [chaleur](chaleur.md)FF, il y a obligatoirement retour à la ligne après la chaîne générée par [matin](matin.md), et ce quelle que soit sa longueur. Cette longueur définit alors la longueur de chaque vers du poème. Si par exemple, [matin](matin.md)--> «La matinée était resplendissante», LV = 32. Le découpage de la suite de la chaîne du poème se fait alors comme dans vers-régulier mais en prenant en compte cette nouvelle contrainte.


:NB. Il y a autant de retour à la ligne que de marqueur : [matin](matin.md)%%[mer](mer.md) [chaleur](chaleur.md)FF entraîne un double retour à la ligne après l’événement matin et [matin](matin.md)%[mer](mer.md)%[chaleur](chaleur.md)FF entraîne un retour à la ligne après [mer](mer.md) quel que soit par ailleurs le découpage en vers-défini.


#### 3.4.2.3. Poésie en vers-libre : ####

:La valeur des deux derniers caractères du descripteur contextuel entraîne une variation aléatoire de découpage entre 15 et XX. Si, par exemple XX = 55 et que la chaîne à découper soit : «Le ciel est par-dessus le toit si bleu si calme pas un bruit pas un son tout semble si paisible dans cette matinée d’été où même les cigales préfèrent paresser à l’ombre bleue des oliviers...», l’affichage peut être :


:Le ciel est par-dessus22

:le toit si bleu si calme pas un bruit pas un son tout54

:semble si paisible19

:dans cette matinée d’été où28

:même les cigales préfèrent paresser à l’ombre bleue53

:des oliviers13


:ou


:Le ciel est par-dessus le toit si bleu39

:si calme pas un16

:bruit pas un son17

:tout semble si paisible24

:dans cette matinée d’été où même33

:les cigales préfèrent paresser à l’ombre bleue des52

:oliviers9


:Le saut à ligne des vers libres peut être contraint par les données intermédiaires elles-même (présence du descripteur %, par exemple).


#### 3.4.2.4. Poésie en vers-défini centré : ####

:Un vers défini est défini par un marqueur inséré dans la chaîne de l’événement générique du poème. Dans hypercard, ce marqueur est «%». Il indique un retour forcé à la ligne quelle que soit la longueur de la chaîne générée précédemment. Par exemple, si l’événement générique est : [matin](matin.md)%[mer](mer.md) [chaleur](chaleur.md)FF, il y a obligatoirement retour à la ligne après la chaîne générée par [matin](matin.md), et ce quelle que soit sa longueur.


:Dans le vers défini centré l’affichage se fait au centre de la page. Par exemple :


:«Brun brun, lueur clarté brun, dire%que j'aurais pu ne jamais vous considérer,%fleurs de ce monde! »


:Est affiché :


:«Brun brun, lueur clarté brun, dire

:que j'aurais pu ne jamais vous considérer,

:fleurs de ce monde! »


:NB. Il y a autant de retour à la ligne que de marqueur : [matin](matin.md)%%[mer](mer.md) [chaleur](chaleur.md)FF entraîne un double retour à la ligne après l’événement matin et [matin](matin.md)%[mer](mer.md)%[chaleur](chaleur.md)FF entraîne un retour à la ligne après [mer](mer.md) quel que soit par ailleurs le découpage en vers-défini.


:(Prévoir un marqueur pour le centrage…)


## 3.5. Sélection de choix de formes dans les groupes : ##

:La construction des groupes constituant les événements est définie par : le contenu de l’événement lui-même aspect qui a fait l’objet de tout le traitement des événements


# 4. Lissages stylistiques : #

:Est appelé «lissage stylistique», la possibilité de définir des places mobiles ou aléatoires dans les données.


## 4.1. Mobilité des places : ##

:Par exemple, dans : «ce matin-là, un éléphant, traversa la rue.» on peut considérer que le groupe «ce matin-là» est mobile. On peut en effet obtenir : «un éléphant, ce matin-là, traversa la rue» ou «un éléphant traversa la rue ce matin-là». Cette possibilité de mobilité est indiquée de la façon suivante :


**::utilisation du marqueur «,**»
**::indication des places par le marqueur «,»**

:«,un éléphant,traversa la rue,.,**ce matin-là» est l’écriture permettant d’obtenir n’importe laquelle des chaînes ci-dessus. Le moteur de génération choisit aléatoirement parmi les trois possibilités. Cette possibilité est admise quel que soit le niveau de la donnée.**


:Cette mobilité des places est valable quelle que soit la nature de la donnée : «[matin](matin.md),[personnage](personnage.md),[promenade](promenade.md).,**[soleil](soleil.md)» est une syntaxe licite.**


## 4.2. Groupes facultatifs : ##

:De même, dans : «ce matin-là, un éléphant, traversa la rue.» on peut considérer que le groupe «ce matin-là» est facultatif. Le résultat serait alors : «un éléphant traversa la rue». Cette possibilité de suppression est prise en compte dans la syntaxe de la façon suivante :


**::marqueur de début de groupe facultatif : «<»** ::marqueur de fin de groupe facultatif : «>»

:«un éléphant traversa la rue< ce matin-là>.» est l’écriture permettant d’obtenir une des deux chaînes : «un éléphant traversa la rue.» ou «un éléphant traversa la rue ce matin-là.». Le moteur de génération choisit aléatoirement parmi les deux possibilités.


:Dans la version Java, ce processus est appliqué en cours de génération. Il doit, en fait ne l’être qu’à la fin, juste avant affichage de façon à permettre d’utiliser ces possibilités de choix facultatifs y compris dans les données non-finies.


## 4.3. Groupes facultatifs imbriqués : ##

:Des groupes facultatifs peuvent être internes à d’autres groupes eux-mêmes facultatifs. Par exemple, soit l’événement suivant : «Le jour se levait dans une grande exubérance. La place de la Concorde, noyée de soleil, resplendissait de lumière. Les passants étaient nombreux.»; on peut considérer que le résultat pourrait être soit : «Le jour se levait dans une grande exubérance. Les passants étaient nombreux.», soit «Le jour se levait dans une grande exubérance. La place de la Concorde resplendissait de lumière. Les passants étaient nombreux.». Ces possibilités reviennent à admettre que «La place de la Concorde, noyée de soleil, resplendissait de lumière..» et «, noyée de soleil, » sont des groupes facultatifs. Dans ce cas la suppression se fait en tenant compte de la numération des marqueurs de suppression : «1| indique le début du marqueur numéro 1; |1» indique la fin de ce même marqueur. L’événement ci-dessus est donc en fait marqué ainsi : «Le jour se levait dans une grande exubérance.«1| La place de la Concorde«2|, noyée de soleil,|2» resplendissait de lumière.|1» Les passants étaient nombreux.»


:Le nombre d’imbrications possibles est illimité. Ces imbrications peuvent porter sur n’importe quel niveau de données.


:Les marqueurs de suppression peuvent porter aussi bien sur des groupes internes aux événements que sur des événements composés. Par exemple : [matin](matin.md) «[soleil](soleil.md)» [lieu](lieu.md) est une séquence licite dans laquelle [soleil](soleil.md) est supprimable.


:NB 1. la place de la ponctuation et des blancs dans les groupes supprimables est de la responsabilité des auteurs.

:NB 2. le marquage type « <1| » est lourd et parfois peu efficace. Il serait préférable de s’en dispenser et d’utiliser un algorithme calculant les intrications sans numération.


## 4.4. Compatibilité des lissages : ##

:La mobilité des places est compatible avec la notion de groupe facultatif : «[matin](matin.md)«,[personnage](personnage.md)»,[promenade](promenade.md).,**«[soleil](soleil.md)»» est une syntaxe licite.**


# 5. Transports d’information #

:La notion de contexte est fondamentale. En effet, le sens d’un texte, la possibilité qu’a un lecteur de le recevoir comme tel se construit par juxtaposition et filtrage successif des éléments le constituant. Par exemple les disponibilités sémantiques de “mouton” sont conditionnées par des contextes d’insertions différents dans les phrases suivantes : “les moutons broutent sous le soleil couchant”, “Pierre est un vrai mouton”, “revenons à nos moutons”, etc. Or le contexte ne se construit pas seulement par juxtaposition mais par mémorisation des sélections successives. Il est donc nécessaire de garder une trace mnémonique de ses sélections.


:C’est le rôle des descripteurs contextuels évoqués plus haut, ainsi que celui de la sélection interne à des classes conceptuelles où la valeur mémoire résultante joue, pour la durée d’écriture d’un texte, le rôle de transport dynamique d’information sur un plan sémantique.


:Sur un plan plus proche de la stricte syntaxe, ce problème d’un transport et d’une mémorisation d’information concerne diverses sous-catégories syntaxiques : les pronoms, les adjectifs et les verbes.


## 5.1. Les adjectifs : ##

:“L’adjectif s’accorde en genre et en nombre au substantif auquel il se rapporte” dit la grammaire traditionnelle feignant de croire qu’il s’agit d’un simple problème formel alors que le vrai problème — qu’elle est incapable de traiter — est celui du “rapport” :


### 5.1.1. Adjectifs placés après : ###

:“Pierre, jeune homme toujours vêtu de pourpre, est intelligent...”

:“La présence du prince sur l’astéroïde n’a jamais été expliquée...”


:Comment savoir, sans recours à la sémantique, que l’adjectif “intelligent” doit être accordé à “Pierre” plutôt qu’à “pourpre”, ou que “expliquée” doit se rapporter à “présence” plutôt qu’à “prince” ou “astéroïde” ? Les conditions d’automatisation de ces contextes sémantiques obligeraient à des analyses complexes et très lourdes à implémenter.


:La solution choisie pour le moteur de génération est de formaliser trois objets :


**::un émetteur d’information** ::un transmetteur d’information
**::un récepteur d’informations**

:Définition 1 : tout élément de la sous-catégorie substantif (marqueur “_m”) est émetteur d’information._

:Définition 2 : le transmetteur d’information est un vecteur

:Définition 3 : un récepteur d’information est indiquée par le marqueur “=“


:D’après ces définitions, l’algorithme de transmission d’information dans une séquence générant “l’homme est très souvent une louve agressive pour les hommes ainsi que pour les femmes”, est le suivant :


{|
|:donnée
|sous-cat.
|:genre
|:nombre
|code
|:vecteur
|-
|:[1|m\_homme]
|m_|:masculin
|:singulier
|10
|:10,
|-
|:[0100000|v\_être]
|v_
|

|

|

|

|-
|:[61#](61#.md)
|#
|

|

|

|

|-
|:[69#](69#.md)
|#
|

|

|

|

|-
|:[8|m\_louve]
|m_|:féminin
|:singulier
|20
|:10,20,
|-
|:[=1|a\_agressif]
|a_
|

|

|

|

|-
|:[64#](64#.md)
|#
|

|

|

|

|-
|:[51|m\_homme]
|m_|:masculin
|:pluriel
|11
|:10,20,11,
|-
|:[41#](41#.md)
|#
|_

|

|

|

|-
|:[71#](71#.md)
|#
|

|

|

|

|-
|:[64#](64#.md)
|#
|

|

|

|

|-
|:[51|m\_femme]
|m_|:féminin
|:pluriel
|21
|:10,20,11,21,
|}
:Le vecteur final transmetteur d’information — “10,20,11,21” — est une représentation totale en genre et nombre des substantifs de la chaîne. Lorsqu’il rencontre un adjectif (marqueur “_a”), il lui est signalé que cet adjectif est en attente d’information (marqueur “=“). La génération étant systématiquement gauche --> droite dans la chaîne, lorsque le moteur de génération rencontre cet adjectif, la valeur du vecteur est : “10,20”. La valeur numérique suivant le signe “=“ lui dit qu’il faut prendre l’information sur le vecteur à la position (nombre d’informations sur le vecteur - valeur indiquée + 1), soit : 2-1+1=2,; le moteur de génération considère donc que l’information attendue est “20”, il peut donc accorder l’adjectif au masculin singulier.


{|
|:donnée
|:sous-cat
|:genre
|:nombre
|:code
|:vecteur
|-
|:[1|m\_présence]
|:m_|:féminin
|:singulier
|:20
|:20,
|-
|:[7|m\_prince]
|:m_
|:masculin
|:singulier
|:10
|:20,10,
|-
|:[58#](58#.md)
|:#
|

|

|

|

|-
|:[1|m\_astéroïde]
|:m_|:masculin
|:singulier
|:10
|:20,10,10,
|-
|:[3100000|v\_avoir]
|:v_
|

|

|

|

|-
|:[=x|a\_été]
|:a_|_

|

|

|

|-
|:[=3|a\_expliqué]
|:a_|_

|

|

|

|}

:Lorsque le moteur de génération rencontre “l’adjectif” “a\_été”, la valeur “x” suivant le signe “=“ lui indique qu’il y a blocage de l’information, il adopte donc automatiquement le masculin singulier. Lorsqu’il rencontre l’adjectif “a\_expliqué”, il regarde la position 3-3+1 du vecteur, soit “20” et accorde donc au féminin singulier : “expliquée”.


### 5.1.2. Adjectifs placés avant : ###

:Pour l’adjectif placé avant, l’utilisation du vecteur est impossible puisque la génération est progressive gauche-droite. Cependant, en français, l’adjectif placé avant est toujours dans un contexte immédiat du substantif auquel il s’accorde, ce qui simplifie le problème.


:La solution choisie dans le moteur de génération Hypercard est donc de créer un groupe de données (cf. plus loin fonction adjectif\_placé-avant). Exemples :


:“le petit prince” : [1|a\_petit@m\_prince], le marqueur syntaxique en tête indique le déterminant et le nombre, le substantif suivant le genre.


:C’est la solution choisie dans Hypercard. Il serait bon de la généraliser, ce qui paraît assez simple à réaliser, par exemple :


:“l’élégant petit prince” : [1|a\_élégant|a\_petit@m\_prince]

:“l’élégant et fou petit prince” : [1|a\_élégant|[46#](46#.md)|a\_fou@m\_prince]

:“le plus élégant prince” : [1|[96#](96#.md)|a\_élégant|@m\_prince]

:“le 23 décembre” : [1|23@m\_décembre]


:La définition concrète des solutions reste à faire mais cette extension éliminerait un grand nombre de problèmes actuellement assez mal gérés.


:A l’usage il semble préférable de remplacer ce double système « adjectif placé avant »-« adjectif placé après » par un marquage unificateur de type « 1= » lorsque l’adjectif est avant et « =1 » lorsque l’adjectif est après. Cela suppose cependant une anticipation de la mémoire de calcul.


## 5.2. Les pronoms : ##

:Dans l’espace de la grammaire sémantique, d’autres informations doivent être transportées pour informer le moteur de génération au long de la production du texte. Par exemple :


:“Pierre sortit dans la rue par la porte arrière de sa villa, il n’avait pas envie que qui que ce soit le surprenne et voit son angoisse, il était inquiet, redoutait même son ombre : il partit en catimini...”


:Dans ce texte, l’anaphorisation est — comme toujours — complexe. En effet, l’affectation des pronoms personnels ne relève pas de décisions d’ordre syntaxique, mais d’ordre sémantique. Rien en effet n’indique formellement que le choix correct soit : 1.“Pierre sortit dans la rue par la porte arrière de sa villa, il n’avait pas envie que...”; plutôt que : 2.“Pierre sortit dans la rue par la porte arrière de sa villa, elle n’avait pas envie que...”. Un automate formel aura plutôt tendance à choisir la solution 2 à cause de la proximité formelle. Or cette solution est sémantiquement absurde, une “villa” ne peut pas “avoir d’envies”. Dans les générateurs Hypercard, cette difficulté a été contournée par le choix d’un système simplifié de pronominalisation ; un système réservé à tous les autres anaphores et défini dans la sous-catégorie des adjectifs (marqueur “a\_”).


## 5.3. Les verbes {{fn Les verbes est la seule partie qui demande un sous-programme du moteur différent suivant les langues. <u>Pour l’instant celui-ci n’est pas implémenté dans d’autres langues que pour le français et reste ainsi à construire pour les autres langues. Ce qui suit et concernant le verbe ne concerne donc presque que le français.</u>}}: ##

:Les verbes contiennent un certain nombre d’informations; certaines sont “locales”, d’autres sont transmises. Ces informations sont matérialisées dans le descripteur syntaxique des verbes qui comprend huit chiffres, correspondant à autant de positions, mais doit pouvoir être éventuellement étendu.


:Position 1 : type de négation

:Position 2 : temps verbal

:Position 3 : pronoms sujets définis

:Positions 4 ET 5 : pronoms compléments

:Position 6 : ordre des pronoms sujets

:Position 7 : pronoms indéfinis

:Position 8 : Place du sujet dans la chaîne grammaticale


:La relation avec la « place dus sujet » se gère de la même façon que celle mise en place dans le cadre des accords des adjectifs.


:Les informations nécessaires sont, dans la version Hypercard en partie (pronoms sujete et négation) installés dans le programme lui-même dans la fonction “conjugVerbe” du script de pile, sous la forme.


:put "je ,tu ,il ,nous ,vous ,[=1|a\_il] ,[=1|a\_il] ,[=1|a\_zéro],[=1|a\_zéro],ce ,ça ,on ,ce ,cela " into proSuj

:put "pas ,plus ,jamais ,rien ,que ,personne ,guère ,point " into négaTif


:Dans la version java, ces informations sont implémentées sous forme de fichier externe au moteur syntaxique. Cette implémentation est beaucoup plus souple et uniformise davantage encore la notion de métalangue : le même moteur peut servir à plusieurs langues… Dans la version Hypercard, c’est le cas de l’implémentation des pronoms compléments qui se présentent sous la forme suivante :


:1,me ,m',

:2,te ,t',

:3,se ,s',

:4,nous ,nous ,

:5,vous ,vous ,

:6,les ,les ,

:7,leur ,leur ,

:8,lui ,lui ,

:9,[=1|a\_le] ,l',

:10,[=2|a\_le] ,l',

:11,[=3|a\_le] ,l',

:12,[=x|a\_le] , l',

:13,

:14,

:15,vous en ,vous en ,

:16,l'on ,l'on ,

:17,s'il ,s'il ,

:18,s'il y ,s'il y ,

:19,d'en ,d'en ,

:20,en ,en ,

:21,m'en ,m'en ,

:22,t'en ,t'en ,

:23,s'en ,s'en ,

:24,y ,y ,

:25,m'y ,m'y ,

:26,t'y ,t'y ,

:27,s'y ,s'y ,

:28,de m'en ,de m'en ,

:29,de t'en ,de t'en ,

:30,de s'en ,de s'en ,

:31,moi ,moi ,

:32,toi ,toi ,

:33,soi ,soi ,

:34,leur en ,leur en ,

:35,d'en ,d'en ,

:36,d'y ,d'y ,

:37,y en ,y en ,

:38,lui en ,lui en,

:39,à ,à ,

:40,de ,d',

:41,pour ,pour ,

:42,que ,qu',



### 5.3.1. Informations “locales” : ###

#### 5.3.1.1. La négation : ####

:La valeur indique le choix entre “ne... pas, ne... plus, etc.” (tableau “négaTif”). la seule contrainte locale est le choix entre “ne” et “n’” définit par la variable “élision”


#### 5.3.1.2. Le temps : ####

:La valeur indique le temps choisit pour la génération calculé dans le tableau “terminaison” des verbes en fonction de la valeur indiquée par les formes verbales intermédiaires et du pronom sujet (cf. ci-dessous). Exemples :


:“2\ rapp|12” : type d’élision “2” + radical “rapp” + type de terminaison “12”

:“2\souv|23” : type d’élision “2” + radical “souv” + type de terminaison “23”


:La seule possibilité exploitable bien que non utilisée encore serait de permettre un changement automatique de temps en fonction de divers paramètres.


#### 5.3.1.3. L’ordre : ####

:L’usage interrogatif implique des changements dans l’ordre de génération des verbes :


:“Il ne pleure pas” --> “Ne pleure-t-il pas”

:“Il ne le pleurera jamais” --> “Ne le pleurera-t-il jamais”

:Etc..


:Avec parfois des incidences sur l’élision : (ceci est géré par “--chaîne finale” dans “conjugVerbe”)


#### 5.3.1.4. Le sujet indéfini : ####

:Dans de nombreux cas en français, le pronom n’a pas une valeur anaphorique précise mais est un simple marqueur syntaxique : “il pleut, il est huit heures, on chante, ça change, ce sont des hommes, c’est beau, il fait beau, etc.”. Dans ce cas, le verbe est automatiquement à la troisième personne et la présence d’un indéfini implique la valeur “0” du marqueur 3 (pronoms sujets)


### 5.3.2. Informations contextuelles : ###

:Les verbes, comme les adjectifs, dépendent de transmissions d’informations contextuelles : “Pierre est heureux, il chante...”; “Marie est heureuse, elle chante...”; etc. Ces demandes contextuelles concernent de la même façon les pronoms sujets et les pronoms compléments.


:Pour les mêmes raisons que pour les adjectifs, la relation entre l’émetteur d’information et le récepteur d’information n’est pas formellement déterminable mais doit être déclarative.


:La première valeur indiquant le rapport du pronom sujet au terme qu’il anaphorise, la deuxième la rapport du pronom complément au terme qu’il anaphorise. Exemple :


{|
|:donnée
|:sous-cat
|genre
|:nombre
|code
|:vecteur
|-
|:[1|m\_cheval]
|:_m
|masculin
|:singulier
|10
|:10,
|-
|:[=x|=x|0100000|v\_être]
|:_v
|

|

|

|

|-
|:[=1|a\_beau]
|:_a
|_

|

|

|

|-
|:[=1|=x|0130000|v\_galoper]
|:_v
|_

|

|

|

|-
|:[48#](48#.md)
|:#
|

|

|

|

|-
|:[1|m\_prairie]
|:_m
|féminin
|:singulier
|20
|:10,20,
|}
:Dans ce cas, le premier verbe (“v\_être”) ne demande ni pronom sujet, ni pronom complément, il est à la troisième personne singulier : “est”; le deuxième verbe (“v\_galoper”) demande un pronom sujet accordé au substantif (1-1+1=1), il ne demande pas de pronom complément : “il galope”._


{|
|:données
|:sous-cat
|:genre
|:nombre
|:code
|:vecteur
|-
|:[0|m\_Pierre]
|:m_|:masculin
|:singulier
|:10
|:10,
|-
|:[=x|=x|0100000|v\_aimer]
|:v_
|

|

|

|

|-
|:[0|m\_Marie]
|:m_|:féminin
|:singulier
|:20
|:10,20,
|-
|:[=2|=1|0130600|v\_regarder]
|:v_
|

|

|

|

|-
|:[69#](69#.md)
|:#
|

|

|

|

|}
:Dans ce cas, le premier verbe (“v\_aimer”) ne demande ni pronom sujet, ni pronom complément, il est à la troisième personne singulier : “aime”; le deuxième verbe (“v\_regarder”) demande un pronom sujet accordé au substantif (2-1+1=2), il demande un pronom complément accordé au substantif (1-1+1=1) : “il la regarde”.


:Bien entendu, le même système que pour les adjectifs pourrait être aussi conservé pour les “héros” avec le même marqueur “≠” ce qui aurait pour effet d’unifier le système...


# 6. Algorithme général d’écriture d’un texte : #




:<u>“Sélection”</u> a deux sens :


**::sauf indication contraire, prendre aléatoirement parmi les données disponibles et non encore utilisées de la classe;** ::si indication précise, prendre la donnée indiquée dans la classe.

:<u>“Évaluation”</u> a deux sens :


**::sans descripteur terminal “FF”, ajouter une nouvelle donnée à la chaîne déjà produite jusqu’à obtention de la longueur de chaîne déterminée pour obtenir un texte;** ::avec descripteur terminal “FF”, développer la donnée jusqu’à obtention de la chaîne et la considérer comme un texte.

# 7. Communication entre générateurs de domaines différents : #

:Un automate est un système, c’est-à-dire un algorithme — ou un ensemble d’algorithmes — utilisant un nombre élevé de variables fortement corrélées.


:Les automates de génération peuvent être ouverts à trois modes de production non-exclusifs : l’automatisme, l’interactivité et l’interaction.


## 7.1. Notion d’automate comme système fermé autonome : ##

:A priori, un automate est un système fermé, il ne communique de façon dynamique qu’avec lui-même dans le seul but de livrer au récepteur un objet fini : texte, image, séquence musicale, etc.




## 7.2. Interactions entre automates : ##

:L’interaction entre automates consiste en l’échange d’information entre automates de domaines différents en vue de la production d’un objet commun appartenant à la fois aux N domaines concernés. Par exemple la génération poésie <=> musique produit un objet qui appartient à la fois — de façon symétrique — au domaine musical et au domaine poétique; la génération d’un opéra numérique concerne au moins trois automates : l’automate générateur de livret, l’automate musical et l’automate de scénarisation. Pour qu’il y ait interaction, il ne peut s’agir en aucun cas de la juxtaposition de produits indépendants présentés simultanément sur une même “scène”, mais d’un produit cohérent à la fois aux N domaines concernés.




## 7.3. Métalangage d’interaction : ##

:Chacun des automates étant un système autonome fonctionnant sur des critères internes propres au domaine dans lequel il est chargé de générer, les informations utiles pour un automate d’un domaine A ne peuvent être directement exploitables par un automate d’un domaine B, sauf à supposer que A et B sont synonymes. Chaque automate ne peut en effet interpréter que les informations adéquates à sa structure de génération.


:Par exemple, un générateur de poésie fonctionne sur des critères tels que “mots, phrases, accords syntaxiques, métaphores, etc.”; un générateur musical fonctionne sur des critères tels que “notes, hauteur des timbres, instruments, rythme, attaque, etc.”. Ces deux champs de critères ne sont en rien homogènes et, pour produire une interaction poésie<=>musique, il est nécessaire de pouvoir traduire les critères d’un automate dans ceux de l’autre : traduire les mots en notes et, au besoin, réciproquement. Cette traduction est la fonction du métalangage d’interaction. Un métalangage d’interaction est donc une grille de correspondance à N éléments, les N éléments étant fonction des domaines sur lesquels travaillent les automates respectifs et du nombre de ces automates.


:C’est en grande partie au niveau du métalangage d’interaction que se constitue l’originalité et la cohérence de l’interaction des automates. Le métalangage d’interaction — du moins en ce qui concerne la génération littéraire — est également construit sur une grammaire sémantique.


## 7.4. Exemple 1 : interaction poésie <=> musique (soirée IRCAM du 14/11/1997) : ##

:Dans ce cas particulier, le métalangage d’interaction a été, pour l’essentiel, constitué par trois ensembles de paramètres :


:— la syntaxe qui constitue la séquentialité de la soirée conçue totalement comme un texte


:— les marques rhétoriques qui installent une relation sur deux critères : tonalité et type de texte.


:— les paramètres sémantiques qui constituent la signification terminale des textes poétiques et musicaux.


### 7.4.1. syntaxe du texte “soirée” : ###

:L’organisation séquentielle de la soirée “Trois mythologies et un poète aveugle” est conçue comme un texte unique. Ce “texte-soirée” {{fn Le “texte-soirée” sera désormais désigné par le seul terme “soirée”.}} est basé sur une grammaire de juxtaposition de classes paradigmatiques d’événements.


:Les classes paradigmatiques disponibles sont : le poète aveugle (PA) — assurant l’unité séquentielle de la soirée —, trois mythologies correspondant chacune aux trois poètes représentés : M1, M2 et M3, un prologue (P), un épilogue (E) et une pause (Pa). Une soirée particulière est donc une phrase constituée des relations entre ces paradigmes.


:**{{fn L’astérisque signifie “est une soirée possible”}} soirée —> P + PA + M1 + M2 + PA + M3 + M1 + PA + E**


:Le Poète aveugle (PA) est aussi une classe paradigmatique constituée elle-même de cinq sous classes : PA1, PA2, PA3, PA4, PA5. Chacune de ces sous-classes correspond à une “tonalité” différente : PA1 = tonalité insistante; P2 = tonalité méditative; P3 = tonalité mystique; P4 = tonalité dramatique; P5 = tonalité lyrique.


:**soirée —> P + PA1 + PA2 + M1 + PA2 + M2 + ... + E**


:Sur cette base, la soirée retenue pour le 14/11/1997, parmi d’autres possibles est représenté par la phrase suivante :


:soirée (14/11/97) —> P + |PA1 + M1 + M3 + M2 + PA2 + PA2| + Pa + |M1 + M1 + M1 + M2 + PA2| + Pa + |PA3 + M2 + M2 + M3 + M2 + PA4| + Pa + |PA5 + M3 + M3 + M3 + M1 + PA5| + E {{fn Remarquons que cette syntaxe permet de créer des niveaux différents d’événements, symbolisés ici par les traits “|” et séparés par une pause. Cette grammaire est donc récursive puisqu’un événement de niveau N a la même structure qu’un événement de niveau N + 1.}}


### 7.4.2. marques rhétoriques : ###

:Des marques rhétoriques peuvent être affectés à chacune des classes paradigmatiques. Pour l’IRCAM, les marques retenues sont :


**::piano (p)** ::percussion (pe)
**::lecture (l)** ::affichage (a)
**::voix chantée (v)**

:Ainsi PA1 [p-a-l] signifie “génération d’un texte de type poète aveugle 1 avec piano, affichage du texte généré et lecture).


:Un trait de durée est affecté à chaque événement.

:Deux traits temporels peuvent être — ou non — affecté à chacune des marques rhétoriques décrivant l’événement :


**::trait de durée** ::trait de début

:p[1,5|3] signifie que la marque rhétorique “piano” débute 1 minute 30 après le début de l’événement qui la contient et qu’elle doit durer 3 minutes.


:— PA1 [[p[0|2,5](.md) - a[1,5|2,5] - l[...|...] 4] signifie que l’événement de type PA1, d’une durée totale de 4 minutes est constitué des trois marques rhétoriques : piano (pour une durée de 2 minutes et demie commençant l’événement), affichage (pour une durée de 2 minutes et demie, commençant une minute trente après le début de l’événement) et lecture pour un début et une durée laissés libres au lecteur à l’intérieur de l’événement total.


:L’ensemble de ces marques constitue le marqueur rhétorique de l’événement.


:soirée (14/11/97) —> P [[p[0|2,5](.md) - a[1,5|2,5] - 4] + Pa[0,5] + |PA1 [[v[0|2](.md) - 2] + M1 [[a[0|2] - 2] + M3 [[a[0|2](.md) - 2] + M2 [[p[0|2](.md) - l[0|2] - 2] + PA2 [[a[0|2](.md) - 2] | + Pa[0,5] + PA2 [[v [0|2](.md)2] + M1 [[l[0|2](.md) - 2] + M1 [[a[0|2](.md) - p [0|2] - 2] + M1 [[l[0|2](.md) - 2] + M2 [l[0|2](.md) - [[0|2](pe.md) - 2] + PA3 [p[0|2](.md) - pe[0|2] - l[0|2] - 2] | + Pa[1](1.md) + | PA3 [[l[0|2](.md) - 2] + M2 [pe[0|2](.md) - p[0|2] - l[0|2] - 2] + M2 [[a[0|2](.md) - 2] + M3 [p[0|2](.md) - a[0|2] - 2] + M2 [[pe[0|1,5](.md) - l[0,5|2] - pe[1|1] 3] + PA4 [v[0|2](.md) - 2] | + Pa[0,5] + | PA5 [pe[0|2](.md) - p[0|2] - v[0|2] - 2] + M3 [p[0|2](.md) - l[0|2] - 2] + M3 [p[0|2](.md) - a[1|2] - 3] + M3 [l[0|2](.md) - pe[0|2] - 2] + M1 [l[0|2](.md) - p[0|2] - 2] + PA5 [pe[0|2](.md) - 2] | + E [v[0|2](.md) - p[1|5] - l[5|3] - 8]


:La durée totale de cette soirée est de 60 minutes, pauses comprises.


:Les marques rhétoriques sont en fait plus riches puisque la marque “lecture” par exemple joue sur trois voix différentes : l1, l2 et l3, mais dans le cas de “Trois mythologies et un poète aveugle”, il a été décidé que la voix 1 lisait toujours PA et M1, la voix 2 lit M2 et la voix 3 lit M3. Cette décision revient à établir une équivalence entre les choix de classe et les choix de voix de lecture : il est donc inutile de les distinguer.


:En ce qui concerne l’affichage, il y a trois possibilités d’affichage : affichage progressif (a1), affichage instantané (a2), affichage partiel (a3). Dans le cadre de cette soirée, il a été décidé que le choix était aléatoire, ce qui rend également inutile le marquage du choix dans la syntaxe de la soirée.


:Enfin, dans le cas pris en exemple, cinq tonalités ont été définies : répétitive, méditative, religieuse, dramatique, lyrique. Cependant, dans ce cas précis, ces tonalités sont redondantes avec le type d’événements puisque PA1 a la tonalité “répétitive”, PA2 la tonalité “méditative”, PA3 la tonalité “mystique”, PA4 la tonalité “dramatique” et PA5 la tonalité “lyrique”, de même que M1 a la tonalité “mystique”, M2 la tonalité “lyrique” et M3 la tonalité “dramatique”. Les tonalités n’ont donc pas à figurer en tant que marques rhétoriques spécifiques. Rien n’empêcherait cependant de les utiliser pour modifier la tonalité de tel ou tel événement.


:Il peut donc y avoir théoriquement autant de marques rhétoriques que les objets des divers domaines permettent de possibilité d’expression. Par exemple, la marque “lecture” pourrait comprendre : voix d’homme, voix de femme, voix d’enfant, voix chuchotée, voix de type x..., etc. de même que les marques musicales sont potentiellement infinies.


:L’ensemble de ces marques constituent les descripteurs rhétoriques des événements.


:La syntaxe sémantique de la soirée peut donc être représentée ainsi :





### 7.4.3. Paramètres sémantiques : ###

:Un événement de la soirée est un “texte” au sens défini précédemment, c’est-à-dire une séquence syntaxico-sémantique. Par exemple, un événement dans PA1 peut être :


:PA1 —> A + B + C + A + ...


:Les événements tombent donc sous le coup général des lois de la génération littéraire. Seulement, pour avoir une cohérence sémantique, il est nécessaire que ces constituants d’événements ne soient pas choisis au hasard par le générateur. Dans le cadre du projet “Trois mythologies et un poète aveugle”, il a donc été décidé que chacun de ces événements comprendrait des liens avec une classe d’objets appelés “thèmes” intermédiaire entre les classes linguistiques et les classes rhétoriques.


:Par exemple, PA1 peut-être aussi bien :


:=D14104000$[0100001|v\_être] [34#](34#.md) [133#](133#.md) [th-événement] [89#](89#.md) [34#](34#.md) [114#](114#.md) [0132400|v\_avoir] [th-objet] [th-objet] [th-objet]« [th-objet]» [89#](89#.md) [34#](34#.md) [133#](133#.md) [th-événement] [89#](89#.md) [th-événement]« [61#](61#.md) [th-événement]» [133#](133#.md) [th-événement] [61#](61#.md) [133#](133#.md) [th-événement] [114#](114#.md) [th-événement] [23#](23#.md) [th-objet] [89#](89#.md) [th-objet]« [34#](34#.md) [133#](133#.md)»« [114#](114#.md) [th-événement]» [89#](89#.md) [th-objet] [55#](55#.md)« [61#](61#.md) [55#](55#.md)»FF


:que :


:=L28225000$[th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique]« [th-lyrique] [th-lyrique]» [th-lyrique] [th-lyrique]« [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique]» [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique] [th-lyrique]FF


:Dans ces événements, au sein de la structure syntaxique, [th-événement], [th-objet] et [th-lyrique] représentent les thèmes. La première partie de l’événement : “=D40000000” et “=F6545454545” représente le descripteur de l’événement; “$” n’est qu’un séparateur formel. Ces descripteurs ont pour rôle essentiel de permettre la communication entre automates :


:— “=D” et “=L” (caractères 1 et 2) sont des codes de contrôle dans les classes

:— “14” (caractères 3 et 4) signifie que l’événement est constitué de 14 thèmes; “28” qu’il est constitué de 28 thèmes

:— “10” (caractères 5 et 6) signifie qu’au moins 10 de ces thèmes sont obligatoires; “22” qu’au moins 22 de ces thèmes sont obligatoires

:— “4” (caractère 7) signifie “tonalité dramatique”, “5” signifie “tonalité lyrique”

:— Les autres caractères sont, pour l’instant, disponibles pour d’autres descriptions sémantiques de ce niveau de données...


:— “FF” en fin de chaîne signifie que la génération doit s’arrêter après développement de la séquence choisie.


:Le nombre de thèmes est théoriquement illimité, il ne dépend que des possibilités expressives des deux automates concernés. Si, par exemple, il n’est pas possible, musicalement, de déterminer plus de 20 thèmes, alors la détermination de plus de 20 thèmes en littérature est absurde pour le générateur poésie <=> musique. Les thèmes sont des classes de choix liées à la syntaxe de la langue et aux divers niveaux de circulation arborescente du dictionnaire.




## 7.5. Exemple 2 : interaction texte <=> musique <=> scénographie : ##

## 7.6. L’interactivité avec les automates : ##

:A la différence de l’interaction qui ne peut être mise en œuvre qu’entre automates, l’interactivité est une relation entre un automate et un humain.





:Les modes de communication n’étant pas exclusives, il peut y avoir interactivité avec un ensemble d’automates en interaction.


### 7.6.1. Métalangage d’interactivité : ###

:L’humain ne pouvant être décrit en termes d’automates, le métalangage d’interactivité ne consiste pas — comme dans le cas de l’interaction — en une traduction d’équivalences entre systèmes mais en la capacité d’interprétation en termes des variables du ou des systèmes automates concernés d’un nombre prédéterminé d’actions humaines captées par des interfaces, quelles qu’elles soient.


# 8. Fonctions syntaxiques #

## 8.1. Rappel : Fonction transfert ##

:Un des principes de base est que, sauf indication explicite contraire, la valeur d'une variable globale se transmet tout le long de la chaîne, quelles que soient les fonctions appelées. Je ne le rappellerai donc pas dans toutes les fonctions.


## 8.2. Remarque préliminaire : ##

:Je ne traite ici que des fonctions syntaxiques. Les descripteurs contextuels sont volontairement ignorés dans tous ces algorithmes puisqu'ils en sont indépendants. Tous les descripteurs sont donc paradigmatiques.


## 8.3. Fonction adjectif\_placé_avant : ##_

:La structure de codage de l'événement "adjectif placé avant" est la suivante :


:[a\_adj1∏a\_adj2∏a\_adjx@m\_subst|valeur]


:Elle s'interprète ainsi :


:[marqueur d'entrée d'événement

:valeurcodage numérique des contraintes syntaxiques

:|séparateur

:a\_adj1premier adjectif

:∏séparateur entre adjectifs (à réaliser en java)

:@séparateur adjectif substantif

:m\_substsubstantif


:Cette structure permet, par exemple, d'obtenir "un bon gros cheval" ou "un grand imbécile" ou "un sacré sale vieux vicieux", etc. Elle peut donc théoriquement intégrer un nombre illimité d'adjectifs placés avant.


:L'algorithme consiste :


**::à décomposer la structure, donc à obtenir le tableau suivant :**

{|
|:valeur
|-
|:substantif
|-
|:adjectif 1
|-
|:adjectif 2
|-
|:adjectif x
|}
**::à extraire "valeur"** ::à analyser le substantif pour en dégager la variable genre (fonction groupe)
**::à analyser adjectif 1, c'est-à-dire à mettre dans une variable globale nommée "élision" (fonction élision) la valeur du premier trait de l'adjectif 1. Par exemple, pour a\_aimable => 1)aimabl|e e es es; a\_grand => 0)gran|d de ds des, la valeur de "élision" est "1" dans le premier cas ("l'aimable") et 0 dans le second ("le grand"). Cette variable "élision" est traitée dans le sous-programme adéquat (cf. plus loin)** ::à fixer le déterminant (fonction valeur)
**::à réaliser l'accord des adjectifs (fonction adjectif)** ::à constituer la chaîne :

:déterminant + adjectif 1 +" "+ adjectif 2 +" "+ adjectif x +" "+ substantif


:Par exemple : [a\_magnifique∏a\_grand@m\_cheval|12]

:valeur = 12

:substantif = m\_cheval

:adjectif 1 = a\_magnifique

:adjectif 2 = a\_grand

:résultat = le magnifique grand cheval


:Remarque : la présence ou non d'espace après le déterminant est gérée par la fonction déterminant (cf. ci-dessous)


:NB 1. les opérations 2, 3, 4 et 5 sont constituer par des sous-fonctions qui serviront dans d'autres fonctions syntaxiques et seront donc décrites plus loin.

:NB 2. Tout ceci est à modifier si l’on adopte un système de marquage unique des adjectifs comme évoqué plus haut


## 8.4. Fonction déterminant : ##

:La finalité de cette fonction est de sélectionner le déterminant, quelle que soit la fonction qui l'appelle. Elle utilise les informations du fichier « déterminant » (cf. annexe 4).


**::la valeur donnée à l'événement** ::les informations portées par le ou les substantifs concernés.
**::le tableau des déterminants.**

:<u>Remarque :</u> dans le tableau, lire le signe «_» comme espace._




:Ce tableau comprend 24 lignes (mais il se peut qu'il en accueille d'autres). Il a la structure suivante :



:"Valeur" peut avoir trois états :


**::état "0" : le déterminant est transmis de l'extérieur. Par exemple : [m\_cheval|7] et [m-chien|0]; "7" indique le déterminant "le, la..."; dans ce cas, la valeur "0" devient "7" ce qui donne : "le cheval et le chien". Alors que "[m\_cheval|10| et [m\_chien|13]" donne "mon cheval et son chien".** ::état >100 : indique le pluriel (variable nombre). "107" est égal au déterminant "7" mais le pointeur prend dans la valeur "pluriel" de la structure : "[m\_cheval|107]" amène : "les chevaux".
**::état "99" : l'événement ne demande aucun déterminant. [m\_cheval|99] => "cheval"; [m\_cheval|199] => "chevaux".**

:<u>Remarque :</u> cette fonction est bien entendu identique dans le cas de la fonction adjectif\_placé_avant : [a\_grand∏a\_stupide@m\_fille|13] => "sa grande stupide fille"_


## 8.5. Fonction élision : ##

:La fonction élision ne peut avoir que deux valeurs : 0 ou 1. Si élision=1 alors la valeur choisie est dans les structures "élision" du tableau; sinon dans les structures "non-élision".


:Par exemple : [m\_éléphant|7] => 1(1)éléphant|s dans lequel la première valeur numérique de l'élément non-fini est "1" indique que ce terme demande l'élision produit "l'éléphant"; [m\_femme|13] => 0(2)femme|s => "sa femme"; [m\_âme|13] => 1(2)âme|s => "son âme"; etc.


:La valeur d'élision dépend du premier terme suivant le déterminant dans la structure. Par exemple dans :


:[a\_grand∏a\_beau@m\_amitié|13], on a :


:0)gran|d de ds des

:0)be|au lle aux lles

:1(2)amitié|s


:la valeur d'élision dépend de a\_grand => "sa grande belle amitié" alors que [m\_amitié|13] => "son amitié" et que [a\_élégant∏a\_jeune@m\_femme|13] => "son élégante jeune femme"; etc.


:Cette fonction élision sera aussi utilisé pour la conjugaison des verbes.


## 8.6. Fonction adjectif : ##

:Concerne le cas le plus répandu, celui de l'adjectif placé après le substantif. Dans ce cas, contrairement à celui de l'adjectif placé avant, l'adjectif est un événement autonome de la forme [a\_mot|...].


:La différence essentielle avec la fonction adjectif\_placé_avant est que la valeur récupérée est propre à l'adjectif. Elle est de la forme "|=x.y.z]"._


:= est un simple marqueur indiquant comment interpréter cette valeur

:. est un séparateur

:x, y et z sont des pointeurs représentés par des valeurs numériques entières.


:Par exemple : "[m\_vallon|7] près [m\_maison|56] [a\_bleu|=2]” signifie que "bleu" s'accorde avec le deuxième mot qui précède l'adjectif, soit ici "vallon" => "le vallon près des maisons bleu". Les pointeurs ne concernent que les substantifs et les pronoms, et aucune autre catégorie.


:Ces pointeurs peuvent avoir trois valeurs distinctes :


:L’accord se fait en récupérant la variable “genre” du substantif pointé et la variable “nombre” du marqueur paradigmatique du substantif pointé. Cela suppose évidemment qu’il y ait une “pile” des nombres et des genres des substantifs rencontrés au cours d’une phase de génération.


<u>a. cas simples :</u>


:"0"l'accord se fait avec le substantif précédent le plus proche

:"x"il n'y a aucun accord et l'adjectif prend la forme masculin singulier

:"valeur"l'accord se fait avec le substantif précédent pointé par la valeur


:Exemples :


:"[m\_vallon|7] près [m\_maison|106] [a\_bleu|=2]” => “le vallon prés des maisons bleu”

:"[m\_vallon|7] près [m\_maison|106] [a\_bleu|=1]” => “le vallon prés des maisons bleues”

:"[m\_vallon|107] près [m\_maison|106] [a\_bleu|=x]” => “les vallons prés des maisons bleu”


<u>b.cas complexes :</u>


:Les cas complexes sont ceux ou 1 ou plusieurs adjectifs s’accordent avec plusieurs substantifs. Exemple : "[m\_vallon|7] et [m\_maison|57] [a\_bleu|=1]” => “le vallon et les maisons bleus”. Dans ce cas, les pointeurs séparés par “.” indiquent les substantifs sur lesquels ils pointent. Les cas complexes ont trois conséquences :


**::le nombre devient automatiquement pluriel : "[m\_vallon|7] et [m\_maison|7] [a\_bleu|=1.2]” => “le vallon et la maison bleus”** ::le genre dépend de la présence d’un masculin. En effet, s’il y a un seul masculin, l’accord est toujours masculin.

:Exemples :


:"[m\_vallée|7] et [m\_maison|7] [a\_bleu|=1.2]” => “la vallée et la maison bleues”

:"[m\_vallon|7] et [m\_maison|7] [a\_bleu|=1]” => “le vallon et la maison bleus”

:"[m\_vallon|7] près [m\_maison|6] [a\_bleu|=2] et [a\_plein|=2] [m\_ombre|6]” => “le vallon près de la maison bleu et plein d’ombre”

:"[m\_vallon|7] et [m\_maison|7] [a\_bleu|=1.2] et [a\_plein|=1.2] [m\_ombre|6]” => “le vallon et la maison bleus et pleins d’ombre”

:etc.


## 8.7. Fonction pronom : ##

:Il existe trois types de pronoms :


:a—Les pronoms de “récit” : ce sont des pronoms dont les marques sont à prendre de façon non-locale. Par exemple lorsque X héros sont déterminés, il existe des pronoms qui se réfèrent à eux tout au long de l’œuvre. Si le héros s’appelle “Pierre”, le pronom est “il”. Dans ce cas, ce pronom est traité comme élément du dictionnaire. C’est une connaissance importée et les fonctions ne s’en occupent pas. <u>J’envisage ainsi de créer des “connaissances sur les héros” à la manière d’un pattern, mais pour l’instant cela n’est implémenté nulle part. Par exemple </u>:


{|
|:Nom du héros, variable [nom-hx]
|:Pierre
|-
|:Pronom, variable [Pro-hx]
|:il
|-
|:Couleur des yeux, variable [coulœil-hx]
|:[a\_bleu](a_bleu.md)
|-
|:Taille, variable [taille-hx]
|:un mètre soixante quinze
|-
|:Couleur des cheveux, variable [coulch-hx]
|:[a\_noir](a_noir.md)
|-
|:Profession, variable [prof-hx]
|:[m\_professeur](m_professeur.md)
|-
|:Etc.
|:Etc.
|}
:La seule contrainte est que, si aucun sexe de héros n’est spécifié à l’origine, le générateur doit pouvoir en affecter un aléatoirement. Ce qui veut dire concrètement que, au départ de la génération, la valeur “genre” est initiée aléatoirement dès l’origine en attente d’autre information.


**::les pronoms locaux qui ont un comportement d’adjectifs. Par exemple : [m\_professeur|7] est [a\_malade|=1], [a\_il|=1] est [a\_absent|=1] aujourd’hui => «le professeur est malade, il est absent aujourd’hui»; mais aussi, si [m\_professeur](m_professeur.md) = 0(1)professeur|s ou 0(2)professeur|s, «¡la professeur est malade, elle est absente aujourd’hui».** ::les pronoms intégrés aux verbes. Ce cas sera traité comme une partie de la conjugaison des verbes (cf. 9.9).

## 8.8. Fonction substantif : ##

:La reconstitution du substantif repose sur deux fonctions :


**::la fonction déterminant qui affecte le déterminant (cf. plus haut)** ::la fonction construction\_substantif qui colle radical et terminaison.

:Les formes semi-finies des substantifs peuvent avoir les formes suivantes :


:0(1)chien|s ou

:0(1)cheva|l ux

:0(1)lilas|0


:Elles sont constituées d’une structure à trois composantes :


**::la composante syntaxique (cf. le premier texte sur la syntaxe) : «0(1)»** ::le radical : «cheva» ou «chien»
**::la ou les terminaisons : “l ux” ou “s”**

:Le terme fini obéit à la règle radical+terminaison. Si la terminaison est unique («s» ci-dessus), alors cette terminaison est celle du pluriel. Si cette terminaison est double, le premier composant est celui du singulier («l» ci-dessus); le second celui du pluriel («ux» ci-dessus). Le choix singulier-pluriel dépend d’une variable «nombre» récupérée dans le calcul du déterminant (x + 50). «0(1)chien|s» correspond donc en fait théoriquement à «0(1)chien|_s». Exemples :_


:[0|m\_cheval] => cheval

:[50|m\_cheva] => chevaux

:[7|m\_cheval] => le cheval

:[57|m\_cheval|107] => les chevaux

:[7|m\_âme] => l’âme

:etc.


## 8.9. Fonction verbe : ##

:De par sa nature, le verbe est le terme le plus complexe à créer. Il comporte en effet un descripteur paradigmatique à 3 structures. Elles seront décrites dans les sous-fonctions concernées. Les structures 2 et 3 doivent pouvoir être ignorées. Leur forme générale est :


**::variables de constitution des verbes : «[...|0000000||...]»**

:L’utilisation de ces pointeurs n’est implémentée ni dans Hypercard ni dans Java. Il pourrait être intéressant de les installer dans la nouvelle version.


:La première structures a huit valeurs (toutes les valeurs ne sont pas affectées pour l’instant). Il comporte également un pointeur de pile. Comme pour les déterminants, le signe «_» indique un espace :_


:Une donnée verbe est donc de la forme : [00000000| v\_courir]


# 6. Ordre : #

:1inversion du sujet


:La construction du verbe obéit à plusieurs sous-fonctions chacune étant chargée de déterminer un élément de la chaîne finale constituant le verbe :


**::sous-fonction «élision\_verbe»** ::sous-fonction «pronominalisation»
**::sous-fonction «conjugaison»** ::sous-fonction «négation»

:Une dernière sous-fonction assure la construction finale du verbe :


**::sous-fonction «chaîne»**

:algorithme de construction de la chaîne verbale :




### 8.9.1. sous-fonction négation : ###

:L’activation de cette sous-fonction dépend de la valeur du premier terme du descripteur pragmatique du verbe. Cette valeur est conservée dans une variable (par ex. négation). Si celle-ci est égale à «0», cette sous-fonction n’est pas utilisée; sinon elle prend la valeur 1. Cette sous-fonction comprend deux parties :


:a-choix de la première partie de la négation :


:Elle fait appel à la fonction “élision\_verbe”. Lorsque la forme intermédiaire du verbe est choisie, elle détermine s’il y a ou non élision. Exemple : 1\aim|6 => la valeur 1 indique qu’il y a élision, donc choix de la forme «n’»; 0\chant|6 => la valeur 0 indique qu’il n’y a pas élision, donc choix de la forme «ne\_». La valeur de la première partie est stockée dans une variable (ex. «debneg») pour utilisation dans la sous-fonction 4.


:b-choix de la deuxième partie de la négation. Ce choix est également stocké dans une variable (ex. «finneg») :


:0pas de négation

:1 pas

:2 plus

:3 jamais

:4 rien

:5 que

:6 personne

:7 guère

:8...

:9pas de «finneg»


:Exemples :


:[v\_rire|3100000] => négation = 1; debneg = «ne\_»; finneg = «jamais»

:[a\_aimer|0100000] => aime; [v\_aimer|1100000] => n’aime pas; [v\_chanter|2100000] => ne chante plus; [v\_pleurer|9100000] => ne pleure...


### 8.9.2. Sous-fonction «pronominalisation» : ###

:Le pronom est un objet complexe qui renvoie à la fois à un mot et à un mot lointain. La sous-fonction pronominalisation est en fait constituée de trois sous-fonctions différentes. Toutes les deux — comme cela a déjà été le cas pour les adjectifs — utilisent la pile de mémorisation des valeurs des substantifs. Le pointeur de pile est, pour le verbe, différent de celui des adjectifs, au lieu du simple marqueur «=», dfans l’idéal il utilise en effet deux marqueurs différents : «<» et «>» (cf. ci-dessous).


:Le pronom a en effet une valeur «interne» au verbe qui est celle de la personne et une valeur externe renvoyant à l’être représenté par cette personne. Par exemple, «je» est une première personne du singulier mais peut renvoyer à un homme ou une femme. Tout pronom contient donc trois valeurs : personne, genre, nombre. Pour que la chaîne verbale se constitue, il faut que ces trois valeurs soient, d’une façon ou d’une autre, connues.


### 8.9.2.1. Sous-fonction «Pronom\_sujet\_indéfini» : ###

:La valeur du septième chiffre du descripteur paradigmatique du verbe indique la présence ou non d’un sujet indéfini. Si cette valeur est 0, cette sous-fonction est ignorée; si cette valeur est différente de 0, c’est la sous-fonction pronom\_sujet (9.9.2.2) qui est ignorée.


:1ce_, c’_

:2ça

:3on

:4il

:5cela


:Une «difficulté» provient de la détermination du nombre pour le pronom indéfini 1. Elle est gérée par la présence ou non du pointeur «.» dans la description paradigmatique du verbe : [v\_être|0100001|.] => «ce sont»; [v\_être|0100001|] => «c’est»; [v\_pleuvoir|0100004||] => «il pleut»...|
|:-----------------------------------|:-------------------------------------|


:La personne du pronom sujet indéfini est toujours égale à 3.

:Une fois calculé, le pronom sujet indéfini se stocke dans la variable prosuj.


#### 8.9.2.2 Sous-fonction «pronom\_sujet» : ####

:La valeur du troisième chiffre du descripteur paradigmatique du verbe indique la personne suivant le tableau ci-dessous :


**::3 ème personne singulier**<u>sans pronom</u> : [v\_chanter|0100000] => «chante»
_::je**, j’ : [v\_chanter|0110000] = > «je chante; [v\_aimer|0110000] => j’aime»** ::tu\_ : [v\_chanter|0120000] => «tu chantes»
**::Pronom sujet «forcé» indéfini => il; [0130000|v\_chanter] => «il chante»** ::nous_ : [v\_chanter|0140000] => «nous chantons»
**::vous**: [v\_chanter|0150000] => «vous chantez»** ::[a\_il](a_il.md) singulier : [v\_chanter|0160000] => «il chante, elle chante»
**::[a\_il](a_il.md) pluriel [v\_chanter|0170000] => «ils chantent, elles chantent»** ::[a\_zéro] singulier [v\_chanter|0180000] => «chante»
_::[a\_zéro] pluriel [v\_chanter|0190000] => «chantent»_

:Ces quatre dernier cas permettant de définir le ou les termes avec les quels le verbe s’accorde à partir d’une distance remontante indiquée en position 8 du descripteur, sur le principe de l’accord des adjectifs. Exempel : [v\_chanter|01800002] => signifie que le verbe s’accorde au deuxième substantif qui le précède.**


:La seule difficulté provient de la troisième personne qui ne peut être déterminée indépendamment du contexte. Elle dépend en effet du substantif sur lequel elle pointe dans la pile. Un autre problème est qu’il faut attendre la fin de l’événement pour savoir sur lequel il pointe dans le cas du sujet après le verbe (est-ce possible ?). De la façon suivante :


:[...|...|<1] signifie que le pronom dépend du premier substantif précédent le verbe. Exemple : [m\_cheval|7] [v\_être|0100000] [a\_beau|=1] [v\_galoper|0130000|<1] => «le cheval est beau, il galope»; [m\_jument|7] [v\_être|0100000] [a\_beau|=1] [v\_galoper|0130000|<1] => «la jument est belle, elle galope»; [v\_chanter|0130000||>2], dans [m\_forêt|7], [m\_oiseau|57] => «chantent, dans la forêt, les oiseaux»|
|:----------------------------------------------------------------------------------------------------------|:---------------------------------------------------------------|


:D’autre part, comme dans le cas des adjectifs, l’accord peut être «complexe» (utilisation du séparateur «.»). Mais dans le cas du verbe, la seule présence de ce séparateur, sans valeur suivante entraîne automatiquement le pluriel, par contre le genre du pronom fonctionne exactement comme pour les adjectifs :


:[m\_cheval|7] et [m\_jument|7] [v\_être|0100000|1.2] [a\_beau|=1] [v\_galoper|0130000||<1.] => «le cheval et la jument sont beaux, ils galopent»|
|:------------------------------------|

:[m\_jument|7] et [m\_pouliche|7] [v\_être|0100000|1.2] [a\_beau|=1.2] [v\_galoper|0130000||<1.2] => «la jument et la pouliche sont belles, elles galopent»|
|:--------------------------------------|


:Un verbe a toujours une personne, même s’il n’a pas de pronom. Par défaut, lorsque la structure 2 du descripteur paradigmatique du verbe est absente par exemple, cette personne est la troisième du singulier masculin.


:La personne du pronom sujet est égale à la valeur, sauf pour 0 et 9, pour laquelle elle est égale à 3.

:Une fois calculé, le pronom sujet se stocke dans la variable prosuj.


#### 8.9.2.3. Sous-fonction «pronom\_complément» : ####

:Si la structure 3 du descripteur paradigmatique du verbe est absente, cette sous-fonction est ignorée.


:Si la valeur des quatrième et cinquième chiffres du descripteur paradigmatique est «00» ou si la structure 3 du descripteur paradigmatique du verbe est absente, cette sous-fonction est ignorée.

:Pour les cas 1, 2 et 3, la fonction élision est nécessaire.

:Pour le cas 7, il faut utiliser un pointeur, le deuxième du descripteur paradigmatique des verbes. Exemple : Marie est venue [v\_parler|01100700|||}<1] => «Marie est venue, je lui parle»

:Une fois calculé, le pronom complément se stocke dans la variable procomp.


### 8.9.3. Sous-fonction «terminaison\_verbes» : ###

:La valeur du deuxième chiffre du descripteur paradigmatique indique le choix des temps verbaux, de la façon suivante :



:1présent

:2imparfait

:3passé simple

:4futur

:5cond. présent

:6subj. présent

:7impératif

:8part. présent

:9infinitif


:Si la valeur est 0, elle est considérée comme égale à 1.

:Les temps verbaux se construisent en fonction du tableau des verbes (cf. annexe, tableau des verbes). Un verbe se construit en fonction de :


:- un radical pris dans la forme intermédiaire du verbe : 0\chant|6, le radical est «chant»; 0\|1, le radical est vide...

:- une terminaison prise dans le tableau des verbes en fonction de la ligne du tableau dont dépend le verbe («...|6» = ligne 6; «...|13» = ligne 13; etc.), de la personne (cf. plus haut) et du temps.


:La structure des lignes du tableau est toujours la même : «présent de l’indicatif + imparfait de l’indicatif + passé simple + futur + conditionnel présent + subjonctif présent + (numéro de ligne.verbe type) + infinitif + participe présent». Pour les six premiers temps, la structure interne est la structure conventionnelle : «personnes 1, 2, 3, 4, 5 et 6». Le participe passé n’est pas pris en compte, il est géré comme un adjectif : [v\_avoir|0130000|.] [a\_chanté|=x] => «ils ont chanté»; [v\_être|0130000|.] [a\_chanté|=x] => «ils sont chantés»; Pierre [v\_être|0130000|.<1] [a\_chanté|=1] => «Pierre est chanté»; Marie [v\_être|0130000||.<1] [a\_chanté|=1] => «Marie est chantée»... Pour les 6 premiers temps, la terminaison se calcule suivant la formule : (temps x 6 + personne) - 6.|
|:-----------------------------------------------------------|:--------------------------------------------------------------------|:----------------------------------------------------------------------|


:La seule particularité concerne l’impératif qui est construit sur le présent mais suivant les verbes sur la 3 ème personne («chante») ou sur la 2 ème («viens»). Il faut donc indiquer la personne. Par défaut, elle a automatiquement la valeur 3 (cf. plus haut).


:La valeur temps se transmet. Elle peut donc suivre toute la chaîne. Par exemple : [v\_rire|0130000] et [v\_pleurer|0000000] et [v\_bégayer|0000000] => «il rit et pleure et bégaie»; [v\_rire|0230000] et [v\_pleurer|0000000] et [v\_bégayer|0000000] => «il riait et pleurait et bégayait».


:Radical + terminaison se stockent dans la variable «verbe».


### 8.9.4. Sous-fonction «ordre» : ###

:La valeur du sixième chiffre du descripteur paradigmatique indique l’ordre de constitution de la chaîne verbale. La variable ordre ne peut avoir que deux valeurs, 0 et 1. «0» signifie ordre norma; «1» signifie ordre inversé.


### 8.9.4. Sous-fonction «élision\_verbe» : ###

:La fonction élision\_verbe analyse :


**::la valeur de la première lettre de la forme verbale intermédiaire. Exemple : 1\aim|6 => élision; 0\chant|6 => non-élision** ::mais dans le cas de verbes à multiples radicaux, cela ne suffit pas. En effet, un verbe comme «être» peut avoir une forme comme «était» ou comme «sera», il est donc impossible a priori de dire s’il y a ou non élision. Il est donc nécessaire de faire un test sur la première lettre du groupe constitué. Ce test dit que si cette première lettre est «é, e, ê, a, i ou y», alors il y a élision.
**::La présence ou non de pronoms compléments change cette valeurlorsque pronomc a les valeurs 20 ou 24, élision = 1; lorsque pronomc a d’autres valeurs, sauf 0, élision = 0**

## 8.10. Sous-fonction «constitution\_chaîne\_verbale» : ##

:La constitution de la chaîne verbale est assez complexe, elle se compose en effet de cinq éléments variables :


:1.le pronom sujet (appelé ici «prosuj»)

:2.la première partie de la négation («debneg»)

:3.La deuxième partie de la négation («finneg»)

:4.Le pronom complément («prodem»)

:5.le constituant verbal lui-même («centre»)


:Il s’agit d’une combinatoire ou interviennent des effets de présence/absence, d’ordre et de contextualisations locales. Il faut donc d’abord constituer les éléments, puis les concaténer.


### 8.10.1. Constitution de «prosuj» : ###

:Deux chaînes symétriques mémorisées permettent de constituer ce pronom sujet :


:a - sans élision : «je ,tu ,[=0|a\_il] ,nous ,vous ,,,,ce ,ça ,on ,ce ,cela »

:b - avec élision :«j’,tu ,[=0|a\_il] nous ,vous ,,,,c’,c’,on ,c’,cela »


:Le choix du pronom dépend de la valeur indiquée dans le descripteur paradigmatique (valeur 3 ou 7 du descripteur) et de la construction contextuelle (élision, cf. plus loin ce thème).


:Remarques :


:La présence d’une valeur 7 (sujet indéfini), a priorité sur toute valeur de pronom sujet. Ainsi, si le DP est [0110001|...], la valeur 1 de 7 a priorité sur la valeur 1 de 3, le pronom choisi est «ce» et non «je»...


:Généralement la personne est la même que celle du pronom sujet sauf :


:— pour 3 («a\_il») puisque celui-ci peut prendre une valeur singulier ou pluriel, ce qui change la terminaison du verbe (remarque : lorsqu’il n’y a pas d’affectation particulière dans le verbe pour le substantif auquel ce «a\_il» se rapporte, la valeur est toujours par défaut masculin-singulier-troisième personne)

:— pour les pronoms indéfinis qui ont tous la même personne 3

:— pour la valeur 0 qui est égale à 3 (cf. 8.9.5.5)


:Le pronom sujet prend deux valeurs (avec ou sans élision) l’affectation définitive à la chaîne verbale se fait en fin de constitution de cette chaîne.


:Prosuj peut être une chaîne vide.


### 8.10.2. Constitution de «debneg» : ###

:Debneg ne prend que l’une ou l’autre des deux valeurs «ne » et «n’»


:Debneg peut être une chaîne vide.


:8.10.3 : Constitution de «finneg» :


:Finneg peut prendre l’une des sept valeur suivantes : "pas ,plus ,jamais ,rien ,que ,personne ,guère ". Finneg peut aussi avoir une valeur vide lorsque le descripteur paradigmatique des verbes correspondant (valeur 1) est égal à 9. Exemples :


:[3100000|v\_chanter] -->«il ne chante jamais»

:[9100000|v\_chanter] --> «il ne chante»


:Finneg peut être une chaîne vide.


:8.10.4. : Constitution de «prodem» :


:Comme pour prosuj, deux chaînes symétriques mémorisées permettent de constituer ce pronom complément :


:a - sans élision : «me ,te ,le ,nous ,vous ,les ,leur ,lui ,la ,se <sub>,</sub><sub>,</sub>en ,m'en ,t'en ,s'en ,y ,m'y ,t'y ,s'y ,,,,moi ,toi ,soi »

:b - avec élision : «m',t',l',nous ,vous ,les ,leur ,lui ,l',s'<sub>,</sub><sub>,</sub>en ,m'en ,t'en ,s'en ,y ,m'y ,t'y ,s'y ,,,,moi ,toi ,soi »


:Le choix de prodem dépend des valeurs 4 et 5 du descripteur paradigmatique : [0130100|v\_chanter] --> «il me chante»; [0132400|v\_venir] --> «il y vient», etc.


:Comme pour le pronom sujet les deux valeurs avec et sans élision sont conservées jusqu’à réalisation de la chaîne finale leur affectation définitive dépendant des contextes locaux.


:Prodem peut être une chaîne vide.


### 8.10.5. Constitution du «centre» : ###

:Lorsque un verbe est appelé, le générateur obtient deux sortes d’informations :


**::celles provenant du descripteur paradigmatique (DP), exemple : « [0130000|v\_aimer]», dans ce cas «0130000»; il indique les contraintes de génération portant sur le verbe.** ::celles provenant du verbe lui-même, exemple [v\_aimer](v_aimer.md) --> 1\aim|6.


:Le «centre» se constitue à partir de ces deux sources d’informations : la valeur 2 du DP indique le temps de conjugaison; la valeur 3 la personne. Le centre se construit à partir du radical (ici «aim») et d’un terminaison dépendant de la conjugaison qui lui est affectée (ici «6»). La formule de calcul est donc la suivante : radical + terminaison dans laquelle, terminaison = élément ((temps\*6+personne)-6) de la chaîne correspondante du tableau verbal.


:Exemples :


:verbe aimer, chaîne du tableau affectée : «e es e ons ez ent ais ais ait ions iez aient ai as a âmes âtes èrent erai eras era erons erez eront erais erais erait erions eriez eraient e e e ions iez ent (6.aimer) ant er». Dans le cas ci-dessus, le temps est le présent (valeur 1), la personne est la troisième du singulier (valeur 3), la terminaison est donc l’item ((1\*6+3)-6)=3, donc «e», le centre du verbe devient «aim + e = aime»


:Message : [0340000|v\_rire], [v\_rire](v_rire.md)--> «0\r|21»; chaîne du tableau affectée (21) : «is is it ions iez ient iais iais iait iions iiez iaient is is it îmes îtes irent irai iras ira irons irez iront irais irais irait irions iriez iraient ie ies ie iions iiez ient (21.rire) iant ire», terminaison : ((3\*6+4)-6)=16, donc «îmes», le centre du verbe devient «r+îmes = rîmes»


:Quatre exceptions à cette règle :


:1. la valeur de la personne est égale à 0 : dans ce cas, elle est considérée comme égale à 3

:2. l’impératif (valeur 7 des temps) : la valeur 7 est égale à la valeur 1 (présent de l’indicatif)

:3. le participe présent (valeur 8) : la terminaison est l’avant dernière valeur de la chaîne de conjugaison

:4. l’infinitif (valeur 9) : la terminaison est la dernière valeur de la chaîne de conjugaison


:Centre ne peut en aucun cas être une chaîne vide.


#### 8.10.6. Contextualisation de la chaîne verbale : ####

:Trois cas définissent la chaîne verbale :


#### 8.10.6.1. Le verbe est à l’infinitif : ####

:(Valeur 9 des temps verbaux).


:L’ordre de constitution est le suivant : «debneg&finneg&prodem&centre».

:Les seuls problèmes de contextualisation locales sont ceux de «debneg» et de «prodem» : Si prodem n’est pas vide, sa valeur élidée ou non dépend de la première lettre du centre ou de la déclaration d’élision, notamment dans le cas du “h”; si prodem est vide, le relais est alors transmis à debneg. De plus si la structure constituée est «debneg+prodem+centre», une contextualisation locale intervient entre debneg et prodem (par exemple : «n’y rien faire»). Le principe est donc de partir du centre et d’ajouter les éléments en remontant vers le début de chaîne et en choisissant localement les bonnes valeurs.


:Exemples :


:- ne pas aimer

:- n’aimer

:- ne pas s’en faire

:- ne pas l’aimer

:- etc.


#### 8.10.6.2. Ordre «inversé» : ####

:La valeur 6 du descripteur paradigmatique est 6, cette valeur implique un ordre dit «inversé». cet ordre de constitution est le suivant : «debneg&prodem&centre&sujet&finneg ». Dans ce cas, la contextualisation locale intervient non seulement avant le verbe, toujours en fonction de prodem et de debneg (cf. 8.10.6.1) mais également en fin de verbe.


:Il y a d’abord automatiquement adjonction de «-» à centre : «aime» devient «aime-»; «partit» devient «partit-».


:Si le centre se termine par «e» ou «a» et que la personne soit la troisième, il y a en plus ajout de «t-» à centre : «aime-» devient «aime-t-»; «chanta-» devient «chanta-t-»; par contre «partit-» ne change pas.


:Si le centre se termine par «e» et que la personne soit la première, le «e» du centre» devient «é-» : «aime» devient «aimé-»; «aima-» reste «aima-»


:Exemples :


:- l’aima-t-elle

:- l’aima-t-il

:- aimé-je les femmes

:- sourions-nous

:- ne sourions-nous pas

:- n’aimé-je pas les chants

:-etc.


#### 8.10.6.3. Ordre normal : ####

:L’ordre normal est : «sujet&debneg&prodem&centre&finneg». Les problèmes de contextualisation locales sont alors ceux de «sujet», «debneg» et «prodem» : Si prodem n’est pas vide, sa valeur élidée ou non dépend de la première lettre du centre ou de la déclaration d’élision, notamment dans le cas du “h”; si prodem est vide, le relais est alors transmis à debneg, et si «debneg» est vide, l’élision dépend du sujet (cf.8.10.6.1).


:Exemples :


:- j’aime

:- je n’aime pas

:- je ne les aime pas

:- je ne l’aime pas

:- je le hais

:- j’honore mes ancêtres

:- je ne vous honore pas

:- c’est

:- ce n’est pas

:- ça n’est pas

:- ce n’en est pas

:- j’en veux

:- etc.


# Annexe 1. Tableau des verbes français #

:Il faut, sur le même modèle établir un tableau des verbes pour chacune des autres langues envisagées.


:


# DS\_conjugaisons #
## terminaisons ##
ai,as,a,avons,avez,ont,avais,avais,avait,avions,aviez,avaient,eus,eus,eut,eûmes,eûtes,eurent,aurai,auras,aura,aurons,aurez,auront,aurais,aurais,aurait,aurions,auriez,auraient,aie,aies,ait,ayions,ayiez,aient,(1.avoir),ayant,avoir

suis,es,est,sommes,êtes,sont,étais,étais,était,étions,étiez,étaient,fus,fus,fut,fûmes,fûtes,furent,serai,seras,sera,serons,serez,seront,serais,serais,serait,serions,seriez,seraient,sois,sois,soit,soyions,soyiez,soient,(2.être),étant,être

is,is,it,isons,ites,isent,isais,isais,isait,isions,isiez,isaient,is,is,it,îmes,îtes,irent,irai,iras,ira,irons,irez,iront,irais,irais,irait,irions,iriez,iraient,ise,ises,ise,isions,isiez,isent,(3.dire),isant,ire

ette,ettes,ette,etons,etez,ettent,etais,etais,etait,etions,etiez,etaient,etai,etas,eta,etâmes,etâtes,etèrent,etterai,etteras,ettera,etterons,etterez,etteront,etterais,etterais,etterait,etterions,etteriez,etteraient,ette,ettes,ette,etions,etiez,ettent,(4.jeter),etant,eter

e,es,e,ons,ez,ent,ais,ais,ait,ions,iez,aient,ai,as,a,âmes,âtes,èrent,erai,eras,era,erons,erez,eront,erais,erais,erait,erions,eriez,eraient,e,e,e,ions,iez,ent,(6.aimer),ant,er

ce,ces,ce,çons,cez,cent,çais,çais,çait,cions,ciez,çaient,çai,ças,ça,çâmes,çâtes,cèrent,cerai,ceras,cera,cerons,cerez,ceront,cerais,cerais,cerait,cerions,ceriez,ceraient,ce,ces,ce,cions,ciez,cent,(7.placer),çant,cer

e,es,e,eons,ez,ent,eais,eais,eait,ions,iez,eaient,eai,eas,ea,eâmes,eâtes,èrent,erai,eras,era,erons,erez,eront,erais,erais,erait,erions,eriez,eraient,e,es,e,ions,iez,ent,(8.manger),eant,er

ète,ètes,ète,étons,étez,ètent,étais,étais,était,étions,étiez,étaient,étai,étas,éta,étâmes,étâtes,étèrent,éterai,éteras,étera,éterons,éterez,éteront,éterais,éterais,éterait,éterions,éteriez,éteraient,ète,ètes,ète,étions,étiez,ètent,(10.inquiéter),étant,éter

elle,elles,elle,elons,elez,ellent,elais,elais,elait,elions,eliez,elaient,elai,elas,ela,elâmes,elâtes,elèrent,ellerai,elleras,ellera,ellerons,ellerez,elleront,ellerais,ellerais,ellerait,ellerions,elleriez,elleraient,elle,elles,elle,elions,eliez,ellent,(11.appeler),elant,eler

ète,ètes,ète,etons,etez,ètent,etais,etais,etait,etions,etiez,etaient,etai,etas,eta,etâmes,etâtes,etèrent,èterai,èteras,ètera,èterons,èterez,èteront,èterais,èterais,èterait,èterions,èteriez,èteraient,ète,ètes,ète,etions,etiez,ètent,(12.acheter),etant,eter

èle,èles,èle,élons,élez,élent,élais,élais,élait,élions,éliez,élaient,élai,élas,éla,élâmes,élâtes,élèrenl,élerai,éleras,élera,élerons,élerez,éleront,élerais,élerais,élerait,élerions,éleriez,éleraient,èle,èles,èle,élions,éliez,élent,(13.révéler),élant,éler

ège,èges,ège,égeons,égez,ègent,égeais,égeais,égeait,égions,égiez,égeaient,égeai,égeas,égea,égeâmes,égeâtes,égèrent,égerai,égeras,égera,égeront,égerez,égeront,égerais,égerais,égerait,égerions,égeriez,égeraient,ège,èges,ège,égions,égiez,ègent,(14.protéger),égeant,éger

ère,ères,ère,érons,érez,èrent,érais,érais,érair,érions,ériez,éraient,érai,éras,éra,érâmes,érâtes,érèrent,érerai,éreras,érera,érerons,érerez,éreront,érerais,érerais,érerair,érerions,éreriez,éreraient,ère,ères,ère,érions,ériez,èrent,(15.exagérer),érant,érer

aie,aies,aie,ayons,ayez,aient,ayais,ayais,ayait,ayions,ayiez,ayaient,ayai,ayas,aya,ayâmes,ayâtes,ayèrent,aierai,aieras,aiera,aierons,aierez,aieront,aierais,aierais,aierait,aierions,aieriez,aieriont,aie,aies,aie,ayions,ayiez,aient,(16.essayer),ayant,ayer

ie,ies,ie,yons,yez,ient,yais,yais,yait,yions,yiez,yaient,yai,yas,ya,yâmes,yâtes,yèrent,ierai,ieras,iera,ierons,ierez,ieront,ierais,ierais,ierait,ierions,ieriez,ieraient,ie,ies,ie,yions,uiez,ient,(17.broyer),yant,yer

cris,cris,crit,crivons,crivez,crivent,crivais,crivais,crivait,crivions,criviez,crivaient,crivis,crivis,crivit,crivîmes,crivîtes,crivirent,crirai,criras,crira,crirons,crirez,criront,crirais,crirais,crirait,cririons,cririez,criraient,crive,crives,crive,crivions,criviez,crivent,(18.écrire),crivant,crire

is,is,it,issons,issez,issent,issais,issais,issait,issions,issiez,issaient,is,is,it,îmes,îtes,irent,irai,iras,ira,irons,irez,iront,irais,irais,irait,irions,iriez,iraient,isse,isses,isse,issions,issiez,issent,(19.finir),issant,ir

e,es,e,ons,ez,ent,ais,ais,ait,ions,iez,aient,is,is,it,îmes,îtes,irent,irai,iras,ira,irons,irez,iront,irais,irais,irait,irions,iriez,iraient,e,es,e,ions,iez,ent,(20.couvrir),ant,ir

is,is,it,ions,iez,ient,iais,iais,iait,iions,iiez,iaient,is,is,it,îmes,îtes,irent,irai,iras,ira,irons,irez,iront,irais,irais,irait,irions,iriez,iraient,ie,ies,ie,iions,iiez,ient,(21.rire),iant,ire

vais,vas,va,allons,allez,vont,allais,allais,allait,allions,alliez,allaient,allai,allas,alla,allâmes,allâtes,allèrent,irai,iras,ira,irons,irez,iront,irais,irais,irait,irions,iriez,iraient,aille,ailles,aille,allions,alliez,aillent,(22.aller),allant,aller

iens,iens,ient,enons,enez,iennent,enais,enais,enait,enions,eniez,enaient,ins,ins,int,înmes,întes,inrent,iendrai,iendras,iendra,iendrons,iendrez,iendront,iendrais,iendrais,iendrait,iendrions,iendriez,iendraient,ienne,iennes,ienne,enions,eniez,iennent,(23.tenir),enant,enir

is,is,it,ivons,ivez,ivent,ivais,ivais,ivait,ivions,iviez,ivaient,écus,écus,écut,écûmes,écûtes,écurent,ivrai,ivras,ivra,ivrons,ivrez,ivront,ivrais,ivrais,ivrait,virions,ivriez,ivraient,ive,ives,ive,ivions,iviez,ivent,(24.vivre),ivant,ivre

s,s,t,tons,tez,tent,tais,tais,tait,tions,tiez,taient,tis,tis,tit,tîmes,tîtes,tirent,tirai,tiras,tira,tirons,tirez,tiront,tirais,tirais,tirait,tirions,tiriez,tiraient,te,tes,te,tions,tiez,tent,(25.sentir),tant,tir

ins,ins,int,ignons,ignez,ignent,ignais,ignais,ignait,ignions,igniez,ignaient,ignis,ignis,ignit,ignîmes,ignîtes,ignirent,indrai,indras,indra,indrons,indrez,indront,indrais,indrais,indrait,indrions,indriez,indraient,igne,ignes,igne,ignions,igniez,ignent,(26.feindre-craindre),ignant,indre

e,es,e,ons,ez,ent,ais,ais,ait,ions,iez,aient,is,is,it,îmes,îtes,irent,irai,iras,ira,irons,irez,iront,irais,irais,irait,irions,iriez,iraient,e,es,e,ions,iez,ent,(27.couvrir),ant,ir

iers,iers,iert,érons,érez,ièrent,érais,érais,érait,érions,ériez,éraient,is,is,it,îmes,îtes,irent,errai,erras,erra,errons,errez,erront,errais,errais,errait,errions,erriez,erraient,ière,ières,ière,érions,iériez,ièrent,(28.quérir),érant,érir

oie,oies,oie,oyons,oyez,oient,oyais,oyais,oyait,oyions,oyiez,oyaient,oyai,oyas,oya,oyâmes,oyâtes,oyèrent,oierai,oieras,oiera,oierons,oierez,oieront,oierais,oierais,oierait,oierions,oieriez,oieraient,oie,oies,oie,oyions,oyiez,oient,(29.broyer),oyant,oyer

ois,ois,oit,uvons,uvez,oivent,uvais,uvais,uvait,uvions,uviez,uvaient,us,us,ut,ûmes,ûtes,urent,oirai,oiras,oira,oirons,oirez,oiront,oirais,oirais,oirait,oirions,oiriez,oiraient,oive,oives,oive,uvions,uviez,oivent,(30.boire),uvant,oire

ains,ains,aint,aignons,aignez,aignent,aignais,aignais,aignait,aignions,aigniez,aignaient,aignis,aignis,aignit,aignîmes,aignîtes,aignirent,aindrai,aindras,aindra,aindrons,aindrez,aindront,aindrais,aindrais,aindrait,aindrions,aindriez,aindraient,aigne,aignes,aigne,aignions,aigniez,aignent,(31.craindre),aignant,aindre

s,s,t,mons,mez,ment,mais,mais,mait,mions,miez,maient,mis,mis,mit,mîmes,mîtes,mirent,mirai,miras,mira,mirons,mirez,miront,mirais,mirais,mirait,mirions,miriez,miraient,me,mes,me,mions,miez,ment,(32.dormir),mant,mir

s,s,t,ons,ez,ent,ais,ais,ait,ions,iez,aient,us,us,ut,ûmes,ûtes,urent,rai,ras,ra,rons,rez,ront,rais,rais,rait,rions,riez,raient,e,es,e,ions,iez,ent,(33.courir),ant,ir

eurs,eurs,eurt,ourons,ourez,eurent,ourais,ourais,ourait,ourions,ouriez,ouraient,ourus,ourus,ourut,ourûmes,ourûtes,oururent,ourrai,ourras,ourra,ourrons,ourrez,ourront,ourrais,ourrais,ourrait,ourrions,ourriez,ourraient,eure,eures,eure,ourions,ouriez,eurent,(34.mourir),ourant,ourir

s,s,t,vons,vez,vent,vais,vais,vait,vions,viez,vaient,vis,vis,vit,vîmes,vîtes,virent,virai,viras,vira,virons,virez,viront,virais,virais,virait,virions,viriez,viraient,ve,ves,ve,vions,viez,vent,(35.servir),vant,vir

uis,uis,uit,uyons,uyez,uient,uyais,uyais,uyait,uyions,uyiez,uyaient,uis,uis,uit,uîmes,uîtes,uirent,uirai,uiras,uira,uirons,uirez,uiront,uirais,uirais,uirait,uirions,uiriez,uiraient,uie,uies,uie,uyions,uyiez,uient,(36.fuir),uyant,uir-,(37.ouïr)

ois,ois,oit,oyons,oyez,oient,oyais,oyais,oyait,oyions,ouiez,oyaient,is,is,it,îmes,îtes,irent,errai,erras,erra,errons,errez,erront,errais,errais,errait,errions,erriez,erraient,oie,oies,oie,oyions,oyiez,oient,(19.voir),oyant,oir


# Annexe 2 : Liste des descripteurs de la version Hypercard #

:Le choix des symboles dans cette liste est arbitraire et peut être, en fonction des contraintes de tel ou tel langage informatique, complètement différent.

{|
|:[
|:début d’une étiquette de classe
|-
|:]
|:fin d’une étiquette de classe
|-
|:|
|:séparateur de classe dépendante à l’intérieur d’une classe
|-
|:#
|:renvoie à la classe des données de type “#”
|-
|:$
|:fin de descripteur de texte
|-
|

|:Marqueurs paradigmatiques
|-
|:v_|:indicateur de la classe “verbes”
|-
|:a_
|:indicateur de la classe “adjectifs”
|-
|:m_|:indicateur de la classe substantif
|-
|:s_
|:indicateur de la classe “syntagme”
|-
|:@
|:séparateur dans les adjectifs placés avant
|-
|

|:Marqueurs rhétoriques
|-
|:FF
|:arrêt forcé de développement d’une chaîne de caractères
|-
|:,**|:chaîne de caractère déplaçable (“,”) indique alors les places possibles
|-
|:< ou <x|
|:début de chaîne de caractères facultative
|-
|:> ou |x>
|:fin de chaîne de caractère facultative
|-
|**

|:Marqueurs de valeurs syntaxiques
|-
|:\
|:marqueurs de verbes
|-
|:]]
|:indique dans carac le choix d’un élément parmi une classe d’éléments
|-
|:)
|:marqueurs de substantifs et adjectifs
|-
|:(
|:marqueurs de substantifs
|}
# Annexe 3 : Liste des syntagmes (14/11/2003, à compléter…) #

:à, 1

:afin, 2

:[0|m\_ailleurs], 3

:ainsi, 4

:alors, 5

:après, 6

:assez, 7

:au fur et à mesure, 8

:au gré, 9

:au-dedans, 10

:au-dehors, 11

:au-delà, 12

:au-dessous, 13

:au-dessus, 14

:aujourd'hui, 15

:auparavant, 16

:auprès, 17

:aussi, 18

:aussitôt, 19

:autant, 20

:autour, 21

:autrement, 22

:avec, 23

:beaucoup, 24

:bientôt, 25

:ça, 26

:car, 27

:ce, 28

:cela, 29

:cependant, 30

:chacun, 31

:ci, 32

:combien, 33

:comme, 34

:comment, 35

:[0|m\_contre], 36

:d’, 37

:dans, 38

:davantage, 39

:de, 40

:[m\_dedans](m_dedans.md), 41

:[m\_dehors](m_dehors.md), 42

:déjà, 43

:[m\_demain](m_demain.md), 44

:depuis, 45

:[0|m\_derrière], 46

:dès, 47

:dessous, 48

:dessus, 49

:[0|m\_devant], 50

:donc, 51

:dont, 52

:durant, 53

:en, 54

:encore, 55

:enfin, 56

:ensuite, 57

:[0|m\_entre], 58

:envers, 59

:environ, 60

:et, 61

:guère, 62

:hors, 63

:ici, 64

:jamais, 65

:jusqu’, 66

:jusque, 67

:juste, 68

:la plupart, 69

:là, 70

:[0|m\_loin], 71

:longtemps, 72

:lors, 73

:lorsqu', 74

:lorsque, 75

:mais, 76

:malgré, 77

:même, 78

:mieux, 79

:moi, 80

:moins, 81

:naguère, 82

:néanmoins, 83

:ni, 84

:non, 85

:nous, 86

:on, 87

:or, 88

:ou, 89

:où, 90

:oui, 91

:outre, 92

:par, 93

:parce, 94

:parfois, 95

:parmi, 96

:partout, 97

:pas, 98

:pendant, 99

:personne, 100

:peu, 101

:peut-être, 102

:plus, 103

:plusieurs, 104

:plutôt, 105

:pour, 106

:pourquoi, 107

:pourtant, 108

:près, 109

:presque, 110

:puisqu’, 111

:puisque, 112

:qu', 113

:quand, 114

:quasi, 115

:que, 116

:quelconque, 117

:quelqu'un, 118

:quelque chose d'autre, 119

:quelque, 120

:quelquefois, 121

:qui, 122

:quoi, 123

:quoique, 124

:rien d'autre, 125

:rien, 126

:s', 127

:sans cesse, 128

:sans, 129

:sauf, 130

:selon, 131

:seulement, 132

:si, 133

:sinon, 134

:sitôt, 135

:soi, 136

:soit, 137

:-, 138

:sous, 139

:souvent, 140

:suivant, 141

:sur, 142

:surtout, 143

:tandis, 144

:tant pis, 145

:tant, 146

:tantôt, 147

:toi, 148

:tôt, 149

:tout, 150

:très, 151

:trop, 152

:vers, 153

:via, 154

:vite, 155

:voici, 156

:voilà, 157

:volontiers, 158

:vous, 159

:vu, 160

:y, 161

:nul, 162

:puis, 163

:quel, 164

:ô, 165

:je, 166

:te, 167

:[0|m\_avant], 168

:bien, 169

:pourvu, 170

:[s\_hier](s_hier.md), 171

:quant, 172

:ceci, 173

:vôtre, 174

:ne, 175

:chez, 176

:mal, 177

:[0|m\_autrefois], 178

:tard, 179

:quiconque, 180

:quant, 181

:désormais, 182

:autrui, 183

:dorénavant, 184

:certes, 185

:notamment, 186

:-, 187

:-, 188

:-, 189

:-, 190

:-, 191

:-, 192

:-, 193

:-, 194

:-, 195

:-, 196

:-, 197

:-, 198

:[0100001|v\_être], 199

:[s\_beaucoup](s_beaucoup.md), 200

:[1](s_certainement.md), 201

:[s\_complètement 1], 202

:[1](s_longuement.md), 203

:[1](s_maintenant.md), 204

:[2](s_parfois.md), 205

:[1](s_puis.md), 206

:[s\_sans-fin], 207

:soudain, 208

:[s\_souvent](s_souvent.md), 209

:[s\_toujours](s_toujours.md), 210

:[s\_un-peu 1], 211

:[1](s_vraiment.md), 212

:[s\_seulement](s_seulement.md), 213

:-, 214

:-, 215

:that, 216

:and, 217


# Annexe 4 : déterminants #

:DS\_déterminants


:-, -, - ,- ,d'un des ,d'une des ,d'un des ,d'une des , 1

:- , - , - , - ,un de ces ,une de ces ,un de ces ,une de ces , 2

:- , - , - , - ,un de ses ,une de ses ,un de ses ,une de ses , 3

:au ,à la ,à l',à l',aux ,aux ,aux ,aux , 4

:aucun ,aucune ,aucun ,aucune ,aucuns ,aucunes ,aucuns ,aucunes , 5

:ce ,cette ,cet ,cette ,ces ,ces ,ces ,ces , 6

:certain ,certaine ,certain ,certaine ,certains ,certaines ,certains ,certaines , 7

:chaque ,chaque ,chaque ,chaque <sub>,</sub> 8

:d'un ,d'une ,d'un ,d'une ,de , de ,d',d', 9

:de ,de ,d',d',de ,de ,d',d', 10

:du ,de la ,de l',de l',des ,des ,des ,des , 11

:le ,la ,l',l',les ,les ,les ,les , 12

:le plus ,la plus ,le plus ,la plus ,les plus ,les plus ,les plus ,les plus , 13

:leur ,leur ,leur ,leur ,leurs ,leurs ,leurs ,leurs , 14

:mon ,ma ,mon ,mon ,mes ,mes ,mes ,mes , 15

:notre ,notre ,notre ,notre ,nos ,nos ,nos ,nos , 16

:nul ,nulle ,nul ,nulle ,nuls ,nulles ,nuls ,nulles , 17

:quel ,quelle ,quel ,quelle ,quels , quelles ,quels ,quelles , 18

:quelque ,quelque ,quelque ,quelque ,quelques ,quelques ,quelques ,quelques , 19

:son ,sa ,son ,son ,ses ,ses ,ses ,ses , 20

:tel ,telle ,tel ,telle ,tels ,telles ,tels ,telles , 21

:ton ,ta ,ton ,ton ,tes ,tes ,tes ,tes , 22

:tout ,toute ,tout ,toute ,tous ,toutes ,tous ,toutes , 23

:tout ce ,toute cette ,tout cet ,toute cette ,tous ces ,toutes ces ,tous ces ,toutes ces , 24

:tout le ,toute la ,tout l',toute l',tous les ,toutes les ,tous les ,toutes les , 25

:tout leur ,toute leur ,tout leur ,toute leur ,tous leurs ,toutes leurs , tous leurs , toutes leurs , 26

:tout mon ,toute ma ,tout mon ,toute mon ,tous mes ,toutes mes ,tous mes ,toutes mes , 27

:tout notre ,toute notre ,tout notre ,toute notre ,tous nos ,toutes nos ,tous nos ,toutes nos , 28

:tout son ,toute sa ,tout son ,toute son ,tous ses ,toutes ses ,tous ses ,toutes ses , 29

:tout ton ,toute ta ,tout ton ,toute ta ,tous tes ,toutes tes , tous tes , toutes tes , 30

:tout votre ,toute votre ,tout votre ,toute votre ,tous vos ,toutes vos , tous vos ,toutes vos , 31

:un ,une ,un ,une ,des ,des ,des ,des , 32

:un du , une de la ,un de l',une de l',un des ,une des ,un des ,une des , 33

:votre ,votre ,votre ,votre ,vos ,vos ,vos ,vos , 34

:d'autre ,d'autre ,d'autre ,d'autre ,d'autres ,d'autres ,d'autres ,d'autres , 35

:le mien ,la mienne ,le mien ,la mienne ,les miens ,les miennes ,les miens ,les miennes ,36

:que ,que ,qu',qu',que ,que ,qu',qu',37

:- , - , - , - ,un de vos ,une de vos ,un de vos ,une de vos ,38

:- , - , - , - ,un de tes ,une de tes ,un de tes ,une de tes ,39

:- , - , - , - ,un de mes ,une de mes ,un de mes ,une de mes ,40

:qu'un ,qu'une ,qu'un ,qu'une ,que des ,que des ,que des ,que des , 41

:tout celui ,toute celle ,tout celui ,toute celle ,tous ceux ,toutes celles ,tous ceux ,toutes celles ,42

:- , - , - , - ,un de ses ,une de ses ,un de ses ,une de ses ,43

:tout un ,toute une ,tout un ,toute une ,tous les ,toutes les ,tous les ,toutes les ,44

:,45

:,46