import pandas as pd

# Charger les données d'interactions
interactions = pd.read_csv('interactions.csv')  # ID uti
lisateur, ID produit, type (vue, achat), etc.
# Prétraiter les données : filtrage, normalisation, etc.
# ...
# Sauvegarder les données prétraitées
interactions.to_csv('preprocessed_interactions.csv', index=False)