interaction_weights = {
    'rating': 1.0,
    'view': 0.1,
    'add_to_cart': 0.5,
    'purchase': 1.0,
    'favorite': 0.7
}

def map_interactions_to_ratings(interactions):
    ratings = []
    for interaction in interactions:
        weight = interaction_weights.get(interaction['type'], 0)
        ratings.append({
            'user_id': interaction['user_id'],
            'item_id': interaction['item_id'],
            'rating': interaction.get('rating', 1) * weight
        })
    return ratings
