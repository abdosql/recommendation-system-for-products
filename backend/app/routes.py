from flask import Blueprint, request, jsonify
from .cosine_similarity_model import CosineSimilarityModel  # Update the import
from .interaction_weights import map_interactions_to_ratings
import pandas as pd
import logging

main = Blueprint('main', __name__)
cosine_model = CosineSimilarityModel()

@main.route('/train', methods=['POST'])
def train():
    try:
        data = request.get_json()
        if data is None:
            logging.error("No JSON payload found.")
            return jsonify({'error': 'No JSON payload found'}), 400

        interactions = data.get('interactions')
        if interactions is None:
            logging.error("interactions data is required")
            return jsonify({'error': 'interactions data is required'}), 400

        logging.info(f"Received interactions: {interactions}")

        ratings = map_interactions_to_ratings(interactions)
        if not ratings:
            logging.error("No valid ratings could be derived from interactions")
            return jsonify({'error': 'No valid ratings could be derived from interactions'}), 400

        df = pd.DataFrame(ratings)
        logging.info(f"Generated ratings DataFrame: {df}")

        user_item_matrix = df.pivot_table(index='user_id', columns='item_id', values='rating', fill_value=0).values
        logging.info(f"Generated user-item matrix: {user_item_matrix}")

        cosine_model.train_model(user_item_matrix)
        cosine_model.set_users_items(df['user_id'].unique().tolist(), df['item_id'].unique().tolist())
        cosine_model.save_model('cosine_similarity_model.pkl')

        return jsonify({'message': 'Model trained and saved successfully'})
    except ValueError as e:
        logging.error(f"ValueError: {str(e)}")
        return jsonify({'error': str(e)}), 400
    except Exception as e:
        logging.error(f"Exception: {str(e)}")
        import traceback
        traceback.print_exc()
        return jsonify({'error': str(e)}), 500

@main.route('/recommend', methods=['POST'])
def recommend():
    try:
        data = request.get_json()
        if data is None:
            logging.error("No JSON payload found.")
            return jsonify({'error': 'No JSON payload found'}), 400

        user_id = data.get('user_id')
        if user_id is None:
            logging.error("user_id is required")
            return jsonify({'error': 'user_id is required'}), 400

        num_recommendations = data.get('num_recommendations', 5)
        logging.info(f"Received user_id: {user_id} and num_recommendations: {num_recommendations}")

        if user_id not in cosine_model.users:
            logging.error(f"user_id {user_id} not found in the trained model")
            return jsonify({'error': f'user_id {user_id} not found in the trained model'}), 400

        user_index = cosine_model.users.index(user_id)
        recommended_item_indices = cosine_model.recommend(user_index, num_recommendations)
        recommended_item_ids = [cosine_model.items[i] for i in recommended_item_indices]

        return jsonify({'recommended_items': recommended_item_ids})
    except Exception as e:
        logging.error(f"Exception: {str(e)}")
        import traceback
        traceback.print_exc()
        return jsonify({'error': str(e)}), 500
