from app import create_app
from waitress import serve

app = create_app()

if __name__ == '__main__':
    # app.run(debug=True)
    serve(app, host='0.0.0.0', port=8000)

# ? 1. Utiliser Waitress
# ?  Waitress est un serveur de production pur Python qui est compatible avec les systèmes Windows.
# ?  Vous pouvez l'utiliser à la place de Gunicorn.

# TODO: 1 - pip install waitress
# TODO: 2 - waitress-serve --listen=0.0.0.0:8000 run:create_app : démarre votre application Flask sur toutes les interfaces à l'écoute du port 8000.
# ! or
# TODO: 2 - "python run.py" directement :
# ? Cela démarrera votre application Flask sous le serveur Waitress sur http://0.0.0.0:8000.
# ? Vous pouvez alors ouvrir votre navigateur et aller
# ? à http://localhost:8000 pour voir si votre application fonctionne correctement.