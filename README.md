# When he says... 
## Understand what he means!

L’application web WHS (“When He Says… understand what He Means!”) recense des affirmations de
personnes connues (ou inconnues) et explicite leur signification. Par exemple, voici une affirmation de
Jules Renard concernant le sujet « homme » :

“Quand un homme dit: «Je suis heureux», il veut dire bonnement: «J'ai des ennuis qui ne
m'atteignent pas.»” Homme

# Architecture

Le projet est basé sur une architecture trois tiers. A ce stade, un serveur apache avec module PHP permet de faire tourner deux instances de WHS: un client avec une couche de service Bootstrap et un serveur contenant l'API RESTful.
