import pandas as pd


class DataManager:
    def __init__(self, category_path='data/category.csv', product_path='data/product.csv',
                 user_path='data/user.csv'):
        self.user_data = pd.read_csv(user_path)
        self.product_data = pd.read_csv(product_path)
        self.category_data = pd.read_csv(category_path)

    def merge_data(self):
        # Fusion des données produit et catégorie, puis fusion avec les données utilisateur
        data = pd.merge(self.product_data, self.category_data, on='category_id', how='left')
        data = pd.merge(data, self.user_data, on='user_id', how='left')
        return data

    def add_features(self, data):
        # Ajout de caractéristiques comme la popularité des produits
        data['product_popularity'] = data.groupby('product_id')['user_id'].transform('count')
        return data
