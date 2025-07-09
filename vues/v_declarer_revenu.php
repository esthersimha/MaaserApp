<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ajouter un Revenu - MaaserAPP</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: sans-serif;
      background: linear-gradient(to right, #6366f1, #3b82f6);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      width: 100%;
      max-width: 400px;
      padding: 20px;
    }

    .form-card {
      background-color: white;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .form-title {
      color: #4f46e5;
      text-align: center;
      font-size: 24px;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      color: #333;
    }

    .form-group select,
    .form-group input {
      width: 100%;
      padding: 10px 12px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 12px;
      box-sizing: border-box;
    }

    .form-actions {
      text-align: center;
    }

    .form-actions button {
      background-color: #4f46e5;
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.2s ease-in-out;
    }

    .form-actions button:hover {
      background-color: #4338ca;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="form-card">
      <h2 class="form-title">Ajouter un Revenu</h2>
      <form class="form-content">
        <div class="form-group">
          <label>Mois</label>
          <select>
            <option>Mois</option>
            <option>Janvier</option>
            <option>Février</option>
            <option>Mars</option>
            <option>Avril</option>
            <option>Mai</option>
            <option>Juin</option>
            <option>Juillet</option>
            <option>Août</option>
            <option>Septembre</option>
            <option>Octobre</option>
            <option>Novembre</option>
            <option>Décembre</option>
          </select>
        </div>

        <div class="form-group">
          <label>Année</label>
          <select>
            <option>Année</option>
            <option>2025</option>
            <option>2024</option>
            <option>2023</option>
          </select>
        </div>

        <div class="form-group">
          <label>Source Revenu</label>
          <select>
            <option>Source Revenu</option>
            <option>Salaire</option>
            <option>Don</option>
            <option>Investissement</option>
          </select>
        </div>

        <div class="form-group">
          <label>Montant (€)</label>
          <input type="number" placeholder="Montant" />
        </div>

        <div class="form-actions">
          <button type="submit">Valider</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
