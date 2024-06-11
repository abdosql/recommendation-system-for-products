import numpy as np
from scipy.sparse.linalg import svds
import pickle

class SVDModel:
    def __init__(self):
        self.model = None
        self.users = []
        self.items = []

    def train_model(self, user_item_matrix):
        u, s, vt = svds(user_item_matrix, k=50)
        self.model = (u, s, vt)

    def save_model(self, filepath):
        with open(filepath, 'wb') as f:
            pickle.dump(self.model, f)

    def load_model(self, filepath):
        with open(filepath, 'rb') as f:
            self.model = pickle.load(f)

    def set_users_items(self, users, items):
        self.users = users
        self.items = items

    def predict(self, user_index, item_index):
        u, s, vt = self.model
        user_vector = u[user_index, :]
        item_vector = vt[:, item_index]
        return np.dot(user_vector, np.dot(np.diag(s), item_vector))

    def recommend(self, user_index, num_recommendations=5):
        u, s, vt = self.model
        user_vector = u[user_index, :]
        scores = np.dot(user_vector, np.dot(np.diag(s), vt))
        recommended_item_indices = np.argsort(scores)[::-1][:num_recommendations]
        return recommended_item_indices
