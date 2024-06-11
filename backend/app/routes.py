from flask import Blueprint, request, jsonify
from .svd_model import SVDModel
from .interaction_weights import map_interactions_to_ratings
import numpy as np
import pandas as pd

main = Blueprint('main', __name__)
svd_model = SVDModel()



#Training khas json Payload ykun hake
# POST /train
# {
#     "interactions": [
#         {"user_id": 1, "item_id": 5, "type": "view"},
#         {"user_id": 1, "item_id": 6, "type": "purchase"},
#         {"user_id": 2, "item_id": 5, "type": "rating", "rating": 3},
#         {"user_id": 2, "item_id": 7, "type": "add_to_cart"}
#     ]
# }

@main.route('/train', methods=['POST'])
def train():
    data = request.get_json()
    interactions = data.get('interactions')  # List of dictionaries with user_id, item_id, type, and optional rating

    if interactions is None:
        return jsonify({'error': 'interactions data is required'}), 400

    # Map interactions to ratings
    ratings = map_interactions_to_ratings(interactions)

    # Create user-item matrix
    df = pd.DataFrame(ratings)
    user_item_matrix = df.pivot_table(index='user_id', columns='item_id', values='rating', fill_value=0).values

    try:
        svd_model.train_model(user_item_matrix)
        svd_model.set_users_items(df['user_id'].unique().tolist(), df['item_id'].unique().tolist())
        svd_model.save_model('svd_model.pkl')
        return jsonify({'message': 'Model trained and saved successfully'})
    except Exception as e:
        return jsonify({'error': str(e)}), 500


#bensbaa bch t3yt lrecomndations
# POST /recommend
# {
#     "user_id": 1,
#     "num_recommendations": 5
# }

@main.route('/recommend', methods=['POST'])
def recommend():
    data = request.get_json()
    user_id = data.get('user_id')
    num_recommendations = data.get('num_recommendations', 5)

    if user_id is None:
        return jsonify({'error': 'user_id is required'}), 400

    try:
        user_index = svd_model.users.index(user_id)
        recommended_item_indices = svd_model.recommend(user_index, num_recommendations)
        recommended_items = [svd_model.items[i] for i in recommended_item_indices]
        return jsonify({'recommended_items': recommended_items})
    except Exception as e:
        return jsonify({'error': str(e)}), 500
