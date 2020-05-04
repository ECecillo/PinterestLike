
# BDW Projet EnLu

## Members
|  Nom|Prénom  |Numéro étudiant  |
|--|--|--|
|CECILLON  |Enzo  |p1805901  |
| RAKOTOMALA | Lucas | p1803588 |


Referent teacher : Leoppol Ghemmogne-Fossi

  

## Presentation

Ce projet est réalisé dans le cadre de l'UE BDW1
___
### Remarque sur l'utilisation du projet :  
*Pour pouvoir ajouter des images veuillez changer les permissions du dossier.*

- A la racine du dossier tapé ceci:
	- sudo chown -R daemon:daemon ./
	- sudo chmod 777 -R ./


## Avancement

- [X] Configuration espace de travail

  

- [x] Mise en page

  

- [X] Rédaction requête

  

- [x] Login/Logout + ajout nouveaux utilisateurs

  

- [x] Add image

  

- [x] Stats pour admin + page utilisaeur

  

- [x] Fin

  
## Ce que nous n'avons pas faits
- Pour la page utilisateur nous avons décidé de ne pas faire de changement au niveau du pseudonyme de l'utilisateur pusique que le nom des images est lié au pseudonyme des utilisateurs et de la description donné. 
	 - **Idée d'une fonction qui aurait pu faire cela :** 
		 - Une requête SQL avec UPDATE pour le pseudo et lorsque cette requête est éxécuté sur la base de donnée déclencher une nouvelle fonction qui elle va update le nom de l'image lié à l'ancien pseudonyme.

- Style des pages
	- La page de login et inscription n'a pas été modifié par manque de temps.
	- Certaines pages ont des boutons qui n'ont pas été mis en forme (login , inscription).
	- La page n'est pas responsive, nous avions commencé à écrire un peu de javascript pour faire un bouton de navigation pour les portables mais il n'est pas fonctionnel.

## Idées de ce qui aurait pu être ajouté

- Une image de profil pour chaque utilisateur.
- Un fil d'actualité avec les derniers ajouts.
- Une barre de recherche pour pouvoir chercher une image avec sa description.
- Dans la navbar au lieu de se rendre sur une page de login nous aurions pu essayer de créer un modale qui s'occupe de faire la connexion ou alors comme pour les dropdown mais avec un peu plus d'animation.
