import pandas as pd
from sklearn.model_selection import train_test_split
from surprise import Dataset, Reader, SVD
from surprise.model_selection import cross_validate

# Charger les données prétraitées
data = pd.read_csv('preprocessed_interactions.csv')

# Utiliser la librairie Surprise pour créer un Dataset
reader = Reader(rating_scale=(1, 5))
dataset = Dataset.load_from_df(data[['userId', 'productId', 'rating']], reader)

# Diviser les données en ensembles d'entraînement et de test
trainset = dataset.build_full_trainset()

# Entraîner un modèle SVD
model = SVD()
cross_validate(model, dataset, measures=['RMSE', 'MAE'], cv=5, verbose=True)

# Sauvegarder le modèle entraîné
import pickle
with open('model.pkl', 'wb') as f:
    pickle.dump(model, f)