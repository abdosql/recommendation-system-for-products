interaction_weights = {
    'product.rated': 1.0,  # Poids élevé, l'utilisateur exprime une préférence explicite
    'view': 0.1,  # Changé à 'product.viewed' avec un poids pour vue
    'add_to_cart': 0.5,  # Interaction indiquant un intérêt fort mais non définitif
    'purchase': 1.0,  # Poids élevé, achat confirmé
    'favorite': 0.7,  # Interaction forte, l'utilisateur marque le produit comme favori
    'cart.item_added': 0.5,  # Semblable à 'add_to_cart'
    'cart.item_removed': 0.2,  # Indique un désintérêt ou un changement d'avis, poids plus faible
    'product.commented': 0.8,  # Interaction forte, l'utilisateur prend le temps de commenter
    'product.viewed': 0.1  # Interaction passive, simple visualisation
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
