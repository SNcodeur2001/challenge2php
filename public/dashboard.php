app centralise les instances
toutes les dependances dans le projets
pas de classe ::getinstance()
elle defini un tableau statique avec les dependances
getdependencies() qui retourne les instances en prenant le clearstatcache prend la cle s'il existe il prend la classe fait get instace pui le retourne
creer env.php dans config load .env definir des constantes portant les meme nom
pas de creation d'instance dynamiquement 
mettre pdo dans abstact 
design pattern factory
class app = container d'injection de dependance