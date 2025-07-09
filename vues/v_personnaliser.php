<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sources de revenus - MaaserAPP</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #6366f1, #3b82f6);
      display: flex;
      justify-content: center;
      padding: 40px 20px;
      min-height: 100vh;
    }

    .container {
      background: white;
      border-radius: 20px;
      padding: 30px;
      max-width: 750px;
      width: 100%;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    
    h1 {
      color: orange;
      font-size: 30px;
      margin-bottom: 20px;
      text-align: center;
    }

    h2 {
      color: #4f46e5;
      font-size: 20px;
      margin-bottom: 20px;
    }

    .section {
      margin-bottom: 50px;
    }

    .input-row {
      display: flex;
      gap: 10px;
      margin-bottom: 25px;
    }

    input[type="text"],
    input[type="number"] {
      padding: 10px;
      border-radius: 12px;
      border: 1px solid #ccc;
      flex: 1;
    }

    button {
      background-color: #4f46e5;
      color: white;
      border: none;
      padding: 10px 14px;
      border-radius: 10px;
      cursor: pointer;
      font-size: 14px;
      transition: background 0.2s;
    }

    button:hover {
      background-color:orange;
    }

    .item-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 12px;
      padding-bottom: 8px;
      border-bottom: 1px solid #eee;
    }

    .item-label {
      flex: 1;
      font-size: 15px;
    }

    .btn-group {
      display: flex;
      gap: 8px;
    }

    .taux-section {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-top: 10px;
    }

    .taux-section input {
      width: 100px;
    }
    .styled-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  font-size: 16px;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.styled-table thead tr {
  background-color:orange;
  color: #ffffff;
  text-align: left;
}

.styled-table th,
.styled-table td {
  padding: 14px 16px;
}

.styled-table tbody tr {
  border-bottom: 1px solid #dddddd;
  background-color: #f9f9ff;
  transition: background-color 0.2s;
}

.styled-table tbody tr:hover {
  background-color: #eef2ff;
}

.table-btn {
  text-decoration: none;
  padding: 6px 12px;
  border-radius: 8px;
  font-size: 14px;
  color: white;
  font-weight: 500;
  transition: background-color 0.2s;
}

.table-btn.modif {
  background-color: #6366f1;
}

.table-btn.modif:hover {
  background-color: orange;
}

.table-btn.suppr {
  background-color: #ef4444;
}

.table-btn.suppr:hover {
  background-color: #dc2626;
}

  </style>
</head>
<body>
  <div class="container">
    <h1>Personnaliser mes sources de revenus</h1>


    <div class="section">
      <h2>Mes sources de revenus déclarées</h2>

      <!-- Formulaire d'ajout -->
      <form method="POST" action="index.php?uc=personnaliser&action=gestionSourceRevenu">
        <input type="text" name="nouveau_revenu" placeholder="Ajouter une source de revenu">
        <button type="submit" name="ajouter_revenu">Ajouter</button>
      </form>

      <?php if (is_array($sourcesRevenu) && count($sourcesRevenu) > 0) { ?>
        <table class="styled-table">
          <thead>
            <tr>
              <th>Source de revenu</th>
              <th>Modifier</th>
              <th>Supprimer</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sourcesRevenu as $uneSourceRevenu) { ?>
              <tr>
                <td>
                  <form method="POST" action="index.php?uc=personnaliser&action=gestionSourceRevenu">
                    <input type="hidden" name="id" value="<?php echo $uneSourceRevenu['id']; ?>">
                    <input type="text" name="new_libelle" value="<?php echo htmlspecialchars($uneSourceRevenu['libelle']); ?>">
                </td>
                <td>
                    <button type="submit" name="modifier" class="table-btn modif">Modifier</button>
                  </form>
                </td>
                <td>
                  <form method="POST" action="index.php?uc=personnaliser&action=gestionSourceRevenu">
                    <input type="hidden" name="id" value="<?php echo $uneSourceRevenu['id']; ?>">
                    <button type="submit" name="supprimer" class="table-btn suppr">Supprimer</button>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        <p>Aucune source de revenu déclarée.</p>
      <?php } ?>
    </div>


    <div class="section">
      <h2>Mes frais déductibles</h2>

      <!-- Formulaire d'ajout -->
      <form method="POST" action="index.php?uc=personnaliser&action=gestionSourceRevenu">
        <input type="text" name="nouveau_frais" placeholder="Ajouter un frais déductible">
        <button type="submit" name="ajouter_frais">Ajouter</button>
      </form>

      <?php
      $frais_deductibles = $_SESSION['frais_deductibles'] ?? [];
      foreach ($frais_deductibles as $index => $frais) {
      ?>
        <div class="item-row">
          <div class="item-label"><?php echo htmlspecialchars($frais); ?></div>
          <div class="btn-group">
            <form method="POST" action="index.php?uc=personnaliser&action=gestionSourceRevenu">
              <input type="hidden" name="index" value="<?php echo $index; ?>">
              <button type="submit" name="supprimer_frais">Sup</button>
            </form>
            <!-- Tu peux ajouter ici un formulaire de modification si tu veux -->
          </div>
        </div>
      <?php } ?>
    </div>


    <div class="section">
      <h2>Déterminer le taux de donation</h2>
      <form method="POST" action="index.php?uc=personnaliser&action=gestionSourceRevenu">
        <input type="number" name="taux" placeholder="12%" min="0" max="100" step="0.1">
        <button type="submit" name="valider_taux">Valider</button>
      </form>
    </div>

  </div>
</body>
</html>