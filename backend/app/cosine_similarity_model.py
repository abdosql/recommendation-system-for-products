import numpy as np
from sklearn.metrics.pairwise import cosine_similarity
import pickle


class CosineSimilarityModel:
    def __init__(self):
        self.user_similarity_matrix = None
        self.item_similarity_matrix = None
        self.users = []
        self.items = []

    def train_model(self, user_item_matrix):
        # Compute the cosine similarity matrix for users and items
        self.user_similarity_matrix = cosine_similarity(user_item_matrix)
        self.item_similarity_matrix = cosine_similarity(user_item_matrix.T)

    def save_model(self, filepath):
        with open(filepath, 'wb') as f:
            pickle.dump((self.user_similarity_matrix, self.item_similarity_matrix), f)

    def load_model(self, filepath):
        with open(filepath, 'rb') as f:
            self.user_similarity_matrix, self.item_similarity_matrix = pickle.load(f)

    def set_users_items(self, users, items):
        self.users = users
        self.items = items

    def predict(self, user_index, item_index):
        # Predict the rating by taking a weighted sum of the ratings given by similar users/items
        user_similarity = self.user_similarity_matrix[user_index]
        item_similarity = self.item_similarity_matrix[item_index]

        user_ratings = self.user_item_matrix[user_index]
        item_ratings = self.user_item_matrix[:, item_index]

        user_based_prediction = np.dot(user_similarity, user_ratings) / np.sum(user_similarity)
        item_based_prediction = np.dot(item_similarity, item_ratings) / np.sum(item_similarity)

        # Combine the two predictions
        return (user_based_prediction + item_based_prediction) / 2

    def recommend(self, user_index, num_recommendations=5):
        # Recommend items based on the highest predicted ratings for the user
        user_ratings = self.user_item_matrix[user_index]
        predicted_ratings = np.dot(self.user_similarity_matrix[user_index], self.user_item_matrix) / np.sum(
            self.user_similarity_matrix[user_index])

        recommended_item_indices = np.argsort(predicted_ratings)[::-1][:num_recommendations]
        return recommended_item_indices
