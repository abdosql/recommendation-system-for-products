from flask import Flask, request, jsonify
import pickle

app = Flask(__name__)

# Charger le modèle entraîné
with open('model.pkl', 'rb') as f:
model = pickle.load(f)

@app.route('/recommend', methods=['GET'])
def recommend():
    user_id = int(request.args.get('user_id'))
    product_id = int(request.args.get('product_id'))

    # Faire des prédictions avec le modèle
    prediction = model.predict(user_id, product_id)
    return jsonify({'prediction': prediction.est})
    
if __name__ == '__main__':
    app.run(debug=True)