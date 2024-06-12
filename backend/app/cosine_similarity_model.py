import numpy as np
from sklearn.metrics.pairwise import cosine_similarity
import pickle


class CosineSimilarityModel:
    def __init__(self):
        self.model = None
        self.users = []
        self.items = []

    def train_model(self, user_item_matrix):
        similarity_matrix = cosine_similarity(user_item_matrix)
        self.model = similarity_matrix

    def save_model(self, filepath):
        with open(filepath, 'wb') as f:
            pickle.dump(self.model, f)

    def load_model(self, filepath):
        with open(filepath, 'rb') as f:
            self.model = pickle.load(f)

    def set_users_items(self, users, items):
        self.users = users
        self.items = items

    def recommend(self, user_index, num_recommendations=5):
        user_similarities = self.model[user_index]
        recommended_item_indices = np.argsort(user_similarities)[::-1][:num_recommendations]
        return recommended_item_indices
