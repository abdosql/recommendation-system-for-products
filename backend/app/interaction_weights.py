interaction_weights = {
    'onProductRated': 1.0,
    'onProductViewed': 0.1,
    'add_to_cart': 0.5,
    'onProductCommented': 0.5,
    'onCartItemAdded': 0.7,
    'onCartItemRemoved': 0
}

def map_interactions_to_ratings(interactions):
    ratings = []
    for interaction in interactions:
        weight = interaction_weights.get(interaction['type'], 0)
        rating_value = interaction.get('rating', 1) * weight
        ratings.append({
            'user_id': interaction['user_id'],
            'item_id': interaction['item_id'],
            'rating': rating_value
        })
    return ratings