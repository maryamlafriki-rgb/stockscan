<!DOCTYPE html>
<html>
<head>
    <title>StockScan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f2f5;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            width: 220px;
            position: fixed;
            top: 0;
            left: -220px;
            background-color: #0a1f2f;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            transition: left 0.3s;
            z-index: 1000;
        }

        .sidebar a {
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            font-weight: 600;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background-color: #084298;
            border-radius: 5px;
        }

        .sidebar .brand {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #38bdf8;
        }

        .sidebar .close-btn {
            font-size: 25px;
            color: #fff;
            text-align: right;
            padding: 0 20px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .btn-logout {
            margin-top: auto;
            margin-bottom: 20px;
            background-color: #ff6347;
            color: #fff;
            border: none;
            font-weight: 600;
        }

        .btn-logout:hover {
            background-color: #e5533c;
        }

        /* Content area */
        .content {
            margin-left: 0;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        /* Hamburger button */
        .hamburger {
            font-size: 30px;
            cursor: pointer;
            color: #38bdf8;
            margin: 10px;
        }

        .hamburger:hover {
            color: #0d6efd;
        }

        /* Quand la sidebar est ouverte */
        .sidebar.show {
            left: 0;
        }

        .content.shift {
            margin-left: 220px;
        }

        /* ── MODAL FORMATEUR (EduAdmin logic) ── */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(10,31,47,0.55);
            backdrop-filter: blur(4px);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .modal-overlay.show {
            display: flex;
        }

        /* ═══ EduAdmin styles (inside modal only) ═══ */
        .edu-modal {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.18);
            width: 100%;
            max-width: 920px;
            max-height: 90vh;
            overflow-y: auto;
            font-family: 'DM Sans', 'Segoe UI', sans-serif;
            animation: scaleIn 0.25s ease both;
        }
        @keyframes scaleIn {
            from { opacity:0; transform:scale(0.95); }
            to   { opacity:1; transform:scale(1); }
        }

        .edu-topbar {
            background: #0a1f2f;
            padding: 16px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 14px 14px 0 0;
        }
        .edu-topbar-title {
            color: #38bdf8;
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }
        .edu-topbar-badge {
            background: rgba(56,189,248,0.15);
            color: #38bdf8;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-left: 10px;
        }
        .edu-close-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            cursor: pointer;
            opacity: 0.7;
            line-height: 1;
            transition: opacity 0.2s;
        }
        .edu-close-btn:hover { opacity: 1; }

        .edu-body {
            padding: 28px;
        }

        /* LOGIN FORM inside modal */
        .edu-login-wrap {
            max-width: 400px;
            margin: 0 auto;
        }
        .edu-card {
            background: #f5f4f0;
            border: 1px solid #e2e0d8;
            border-radius: 12px;
            padding: 30px;
            margin-top: 10px;
        }
        .edu-card-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #0a1f2f;
            margin-bottom: 4px;
        }
        .edu-card-sub {
            font-size: 0.82rem;
            color: #8890a8;
            margin-bottom: 22px;
        }

        .edu-form-group { margin-bottom: 15px; }
        .edu-form-group label {
            display: block;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #3a3f52;
            margin-bottom: 6px;
        }
        .edu-form-group input,
        .edu-form-group select {
            width: 100%;
            padding: 10px 13px;
            border: 1.5px solid #e2e0d8;
            border-radius: 8px;
            font-size: 0.88rem;
            color: #0a1f2f;
            background: #fff;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            appearance: none;
            font-family: inherit;
        }
        .edu-form-group input:focus,
        .edu-form-group select:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 3px rgba(56,189,248,0.15);
        }
        .edu-form-group input::placeholder { color: #8890a8; }

        .edu-pw-wrap { position: relative; }
        .edu-pw-wrap input { padding-right: 42px; }
        .edu-pw-toggle {
            position: absolute; right: 11px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: #8890a8; display: flex; align-items: center;
            transition: color 0.2s;
        }
        .edu-pw-toggle:hover { color: #0a1f2f; }

        .edu-btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 0.875rem; font-weight: 700;
            cursor: pointer; border: 1.5px solid transparent;
            transition: all 0.18s; font-family: inherit;
            white-space: nowrap;
        }
        .edu-btn-primary { background: #0a1f2f; color: #fff; border-color: #0a1f2f; }
        .edu-btn-primary:hover { background: #0e2d45; }
        .edu-btn-accent { background: #38bdf8; color: #fff; border-color: #38bdf8; }
        .edu-btn-accent:hover { background: #0ea5e9; }
        .edu-btn-outline { background: transparent; color: #3a3f52; border-color: #e2e0d8; }
        .edu-btn-outline:hover { background: #f5f4f0; }
        .edu-btn-danger { background: #fee2e2; color: #dc2626; }
        .edu-btn-danger:hover { background: #fca5a5; }
        .edu-btn-edit { background: #e0f7ff; color: #0ea5e9; }
        .edu-btn-edit:hover { background: #bae6fd; }
        .edu-btn-sm { padding: 6px 12px; font-size: 0.77rem; }
        .edu-btn-full { width: 100%; }

        .edu-divider {
            display: flex; align-items: center; gap: 12px;
            margin: 16px 0; color: #8890a8; font-size: 0.76rem;
        }
        .edu-divider::before, .edu-divider::after {
            content: ''; flex: 1; height: 1px; background: #e2e0d8;
        }

        /* ADMIN TABLE VIEW */
        .edu-page-header {
            display: flex; align-items: flex-end; justify-content: space-between;
            margin-bottom: 20px; flex-wrap: wrap; gap: 12px;
        }
        .edu-page-header h2 { font-size: 1.5rem; font-weight: 700; color: #0a1f2f; }
        .edu-page-header p { font-size: 0.82rem; color: #8890a8; margin-top: 3px; }

        .edu-stats-row { display: flex; gap: 12px; margin-bottom: 18px; flex-wrap: wrap; }
        .edu-stat-chip {
            background: #f5f4f0; border: 1px solid #e2e0d8;
            border-radius: 8px; padding: 12px 18px;
            display: flex; align-items: center; gap: 10px;
        }
        .edu-stat-icon { font-size: 1.1rem; }
        .edu-stat-val { font-size: 1.4rem; font-weight: 700; color: #0a1f2f; line-height: 1; }
        .edu-stat-lbl { font-size: 0.72rem; color: #8890a8; margin-top: 2px; }

        .edu-table-card {
            border: 1px solid #e2e0d8; border-radius: 12px; overflow: hidden;
        }
        .edu-table-toolbar {
            padding: 13px 18px; border-bottom: 1px solid #e2e0d8;
            display: flex; align-items: center; justify-content: space-between; gap: 10px;
            flex-wrap: wrap;
        }
        .edu-search {
            display: flex; align-items: center; gap: 7px;
            background: #f5f4f0; border: 1.5px solid #e2e0d8;
            border-radius: 8px; padding: 7px 11px; width: 220px;
        }
        .edu-search input {
            border: none; background: none; font-size: 0.83rem;
            color: #0a1f2f; outline: none; width: 100%; font-family: inherit;
        }
        .edu-search input::placeholder { color: #8890a8; }

        .edu-table { width: 100%; border-collapse: collapse; }
        .edu-table thead { background: #f5f4f0; }
        .edu-table th {
            padding: 10px 18px; text-align: left;
            font-size: 0.71rem; font-weight: 700; letter-spacing: 0.07em;
            text-transform: uppercase; color: #8890a8;
            border-bottom: 1px solid #e2e0d8; white-space: nowrap;
        }
        .edu-table td {
            padding: 13px 18px; border-bottom: 1px solid #e2e0d8;
            font-size: 0.86rem; color: #0a1f2f; vertical-align: middle;
        }
        .edu-table tr:last-child td { border-bottom: none; }
        .edu-table tbody tr:hover { background: #f8fafc; }

        .edu-email-cell { font-weight: 600; }
        .edu-email-cell span { display: block; font-size: 0.74rem; color: #8890a8; font-weight: 400; }
        .edu-pw-cell { font-family: monospace; letter-spacing: 0.1em; color: #8890a8; font-size: 0.83rem; cursor: pointer; }
        .edu-dept-badge {
            display: inline-block; padding: 3px 9px; border-radius: 20px;
            font-size: 0.72rem; font-weight: 700;
            background: #e0f7ff; color: #0ea5e9;
        }
        .edu-actions { display: flex; gap: 7px; flex-wrap: wrap; }

        .edu-empty { text-align: center; padding: 48px; color: #8890a8; }
        .edu-empty-icon { font-size: 2.5rem; margin-bottom: 10px; opacity: 0.4; }

        /* FORMATEUR CARD inside modal */
        .edu-fmt-card {
            max-width: 400px; margin: 0 auto; text-align: center; padding: 10px 0;
        }
        .edu-fmt-avatar {
            width: 64px; height: 64px; background: #e0f7ff; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px; font-size: 1.8rem;
        }
        .edu-fmt-card h3 { font-size: 1.3rem; font-weight: 700; color: #0a1f2f; margin-bottom: 6px; }
        .edu-fmt-card p { font-size: 0.83rem; color: #8890a8; line-height: 1.6; }
        .edu-info-box {
            background: #f5f4f0; border: 1px solid #e2e0d8;
            border-radius: 8px; padding: 14px 18px; margin: 18px 0; text-align: left;
        }
        .edu-info-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 5px 0; font-size: 0.83rem;
        }
        .edu-info-row:not(:last-child) { border-bottom: 1px solid #e2e0d8; }
        .edu-info-lbl { color: #8890a8; font-weight: 500; }
        .edu-info-val { color: #0a1f2f; font-weight: 700; }

        /* SUB-MODAL (signup/create/edit/delete inside edu-modal) */
        .edu-submodal-overlay {
            position: absolute; inset: 0;
            background: rgba(10,31,47,0.45);
            backdrop-filter: blur(3px);
            border-radius: 14px;
            z-index: 10;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .edu-submodal-overlay.show { display: flex; }
        .edu-submodal {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            width: 100%; max-width: 420px;
            padding: 30px;
            animation: scaleIn 0.22s ease both;
        }
        .edu-submodal-header {
            display: flex; align-items: flex-start; justify-content: space-between;
            margin-bottom: 20px;
        }
        .edu-submodal-title { font-size: 1.15rem; font-weight: 700; color: #0a1f2f; }
        .edu-submodal-close {
            background: none; border: none; cursor: pointer;
            color: #8890a8; font-size: 1.3rem; line-height: 1;
        }
        .edu-submodal-close:hover { color: #0a1f2f; }
        .edu-submodal-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }

        /* TOAST */
        #edu-toast-container {
            position: fixed; top: 20px; right: 20px; z-index: 9999;
            display: flex; flex-direction: column; gap: 9px;
        }
        .edu-toast {
            display: flex; align-items: center; gap: 11px;
            padding: 12px 16px; border-radius: 8px;
            background: white; border: 1px solid #e2e0d8;
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
            font-size: 0.85rem; font-weight: 600; min-width: 250px;
            animation: slideIn 0.3s ease both;
        }
        @keyframes slideIn {
            from { opacity:0; transform:translateX(18px); }
            to   { opacity:1; transform:translateX(0); }
        }
        .edu-toast.success { border-left: 4px solid #16a34a; }
        .edu-toast.error   { border-left: 4px solid #dc2626; }
        .edu-toast.info    { border-left: 4px solid #38bdf8; }

        .hidden { display: none !important; }
    </style>
    <!-- DM Sans for EduAdmin parts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
</head>
<body>

<!-- ══════════════════════════════════════
     STOCKSCAN — ORIGINAL CODE (unchanged)
══════════════════════════════════════ -->

<!-- Hamburger -->
<span class="hamburger" onclick="toggleSidebar()">&#9776;</span>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="close-btn" onclick="toggleSidebar()">×</div>
    <div class="brand">StockScan</div>

    <!-- NEW LINK -->
    <a href="dashboard.php">Accueil</a>

    <a href="articles.php">Articles</a>
    <a href="tableau_de_bord.php">Tableau de bord</a>
    <a href="ajouter_article.php">Ajouter Article</a>

    <!-- Formateurs (EduAdmin modal) -->
    <a href="#" onclick="openEduModal(); toggleSidebar(); return false;">👤 Formateurs</a>

    <a href="login.php" class="btn-logout">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
          <polyline points="16 17 21 12 16 7"/>
          <line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
        Déconnexion
    </a>
</div>

<!-- Content -->
<div class="content" id="content">
    <!-- contenu StockScan ici -->
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    sidebar.classList.toggle('show');
    content.classList.toggle('shift');
}
</script>

<!-- ══════════════════════════════════════
     EDUADMIN MODAL (opens on "Formateurs" click)
══════════════════════════════════════ -->

<!-- Main overlay -->
<div class="modal-overlay" id="edu-modal-overlay" onclick="handleEduOverlayClick(event)">
  <div class="edu-modal" id="edu-modal" style="position:relative;">

    <!-- Topbar -->
    <div class="edu-topbar">
      <div style="display:flex;align-items:center;gap:10px;">
        <span class="edu-topbar-title">EduAdmin</span>
        <span class="edu-topbar-badge" id="edu-role-badge">—</span>
      </div>
      <button class="edu-close-btn" onclick="closeEduModal()">✕</button>
    </div>

    <!-- Body -->
    <div class="edu-body">

      <!-- ── LOGIN VIEW ── -->
      <div id="edu-view-login">
        <div class="edu-login-wrap">
          <div class="edu-card">
            <div class="edu-card-title">Connexion</div>
            <div class="edu-card-sub">Accédez à votre espace EduAdmin</div>

            <div class="edu-form-group">
              <label>Adresse e-mail</label>
              <input type="email" id="edu-login-email" placeholder="votre@email.com"/>
            </div>
            <div class="edu-form-group">
              <label>Mot de passe</label>
              <div class="edu-pw-wrap">
                <input type="password" id="edu-login-password" placeholder="••••••••"/>
                <button class="edu-pw-toggle" onclick="eduTogglePw('edu-login-password',this)">
                  <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                  </svg>
                </button>
              </div>
            </div>
            <button class="edu-btn edu-btn-primary edu-btn-full" onclick="eduHandleLogin()">
              Se connecter
            </button>
            <div class="edu-divider">ou</div>
            <button class="edu-btn edu-btn-outline edu-btn-full" onclick="openEduSubModal('signup')">
              Créer un compte formateur
            </button>
          </div>
        </div>
      </div>

      <!-- ── ADMIN VIEW ── -->
      <div id="edu-view-admin" class="hidden">
        <div class="edu-page-header">
          <div>
            <h2>Gestion des formateurs</h2>
            <p>Gérez les comptes et les accès des formateurs</p>
          </div>
          <button class="edu-btn edu-btn-accent" onclick="openEduSubModal('create')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Créer un formateur
          </button>
        </div>

        <div class="edu-stats-row">
          <div class="edu-stat-chip">
            <span class="edu-stat-icon">👥</span>
            <div>
              <div class="edu-stat-val" id="edu-stat-total">0</div>
              <div class="edu-stat-lbl">Formateurs total</div>
            </div>
          </div>
          <div class="edu-stat-chip">
            <span class="edu-stat-icon">🏛️</span>
            <div>
              <div class="edu-stat-val" id="edu-stat-depts">0</div>
              <div class="edu-stat-lbl">Départements</div>
            </div>
          </div>
        </div>

        <div class="edu-table-card">
          <div class="edu-table-toolbar">
            <div class="edu-search">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#8890a8" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
              </svg>
              <input type="text" id="edu-search" placeholder="Rechercher…" oninput="eduRenderTable()"/>
            </div>
             <a href="login.php" class="btn-logout">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
        Déconnexion
      </a>
          </div>
          <div style="overflow-x:auto">
            <table class="edu-table">
              <thead>
                <tr>
                  <th>Formateur</th>
                  <th>Mot de passe</th>
                  <th>Département</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="edu-tbody"></tbody>
            </table>
          </div>
          <div id="edu-empty" class="edu-empty hidden">
            <div class="edu-empty-icon">📭</div>
            <p>Aucun formateur trouvé</p>
          </div>
        </div>
      </div>

      <!-- ── FORMATEUR VIEW ── -->
      <div id="edu-view-formateur" class="hidden">
        <div class="edu-fmt-card">
          <div class="edu-fmt-avatar">🎓</div>
          <h3>Espace Formateur</h3>
          <p>Bienvenue ! Vous n'avez pas accès à l'administration.</p>
          <div class="edu-info-box">
            <div class="edu-info-row">
              <span class="edu-info-lbl">E-mail</span>
              <span class="edu-info-val" id="edu-fmt-email">—</span>
            </div>
            <div class="edu-info-row">
              <span class="edu-info-lbl">Rôle</span>
              <span class="edu-info-val">Formateur</span>
            </div>
            <div class="edu-info-row">
              <span class="edu-info-lbl">Département</span>
              <span class="edu-info-val" id="edu-fmt-dept">—</span>
            </div>
          </div>
          <button class="edu-btn edu-btn-outline edu-btn-full" onclick="eduLogout()">
            Se déconnecter
          </button>
        </div>
      </div>

    </div><!-- /edu-body -->

    <!-- ══ SUB-MODAL (signup / create / edit / delete) ══ -->
    <div class="edu-submodal-overlay" id="edu-submodal-overlay" onclick="handleSubOverlayClick(event)">
      <div class="edu-submodal" id="edu-submodal">

        <!-- SIGNUP -->
        <div id="edu-sub-signup">
          <div class="edu-submodal-header">
            <div class="edu-submodal-title">Créer un compte formateur</div>
            <button class="edu-submodal-close" onclick="closeEduSubModal()">✕</button>
          </div>
          <div class="edu-form-group"><label>E-mail</label>
            <input type="email" id="edu-su-email" placeholder="votre@email.com"/>
          </div>
          <div class="edu-form-group"><label>Mot de passe</label>
            <div class="edu-pw-wrap">
              <input type="password" id="edu-su-pw" placeholder="Min. 6 caractères"/>
              <button class="edu-pw-toggle" onclick="eduTogglePw('edu-su-pw',this)">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>
          </div>
          <div class="edu-form-group"><label>Département</label>
            <select id="edu-su-dept"><option value="">— Choisir —</option>
              <option>Informatique</option><option>Mathématiques</option><option>Sciences</option>
              <option>Langues</option><option>Gestion</option><option>Droit</option>
              <option>Marketing</option><option>Autre</option>
            </select>
          </div>
          <div class="edu-submodal-actions">
            <button class="edu-btn edu-btn-outline" onclick="closeEduSubModal()">Annuler</button>
            <button class="edu-btn edu-btn-accent" onclick="eduHandleSignup()">Créer</button>
          </div>
        </div>

        <!-- CREATE / EDIT -->
        <div id="edu-sub-form" class="hidden">
          <div class="edu-submodal-header">
            <div class="edu-submodal-title" id="edu-sub-form-title">Créer un formateur</div>
            <button class="edu-submodal-close" onclick="closeEduSubModal()">✕</button>
          </div>
          <input type="hidden" id="edu-form-id"/>
          <div class="edu-form-group"><label>E-mail</label>
            <input type="email" id="edu-form-email" placeholder="formateur@email.com"/>
          </div>
          <div class="edu-form-group"><label>Mot de passe</label>
            <div class="edu-pw-wrap">
              <input type="password" id="edu-form-pw" placeholder="Min. 6 caractères"/>
              <button class="edu-pw-toggle" onclick="eduTogglePw('edu-form-pw',this)">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>
          </div>
          <div class="edu-form-group"><label>Département</label>
            <select id="edu-form-dept"><option value="">— Choisir —</option>
              <option>Informatique</option><option>Mathématiques</option><option>Sciences</option>
              <option>Langues</option><option>Gestion</option><option>Droit</option>
              <option>Marketing</option><option>Autre</option>
            </select>
          </div>
          <div class="edu-submodal-actions">
            <button class="edu-btn edu-btn-outline" onclick="closeEduSubModal()">Annuler</button>
            <button class="edu-btn edu-btn-accent" id="edu-form-submit" onclick="eduHandleFormSubmit()">Créer</button>
          </div>
        </div>

        <!-- CONFIRM DELETE -->
        <div id="edu-sub-confirm" class="hidden">
          <div style="font-size:2rem;margin-bottom:12px;">🗑️</div>
          <div class="edu-submodal-title">Supprimer ce compte</div>
          <p style="color:#8890a8;font-size:.84rem;margin-top:9px;line-height:1.5">
            Êtes-vous sûr de vouloir supprimer <strong id="edu-confirm-email"></strong> ? Action irréversible.
          </p>
          <div class="edu-submodal-actions">
            <button class="edu-btn edu-btn-outline" onclick="closeEduSubModal()">Annuler</button>
            <button class="edu-btn edu-btn-danger" onclick="eduConfirmDelete()">Supprimer</button>
          </div>
        </div>

      </div>
    </div>
    <!-- /sub-modal -->

  </div><!-- /edu-modal -->
</div><!-- /modal-overlay -->

<!-- Toast -->
<div id="edu-toast-container"></div>

<script>
/* ════════════════════════════════
   DATA (localStorage)
════════════════════════════════ */
const EDU_USERS_KEY   = 'eduadmin_users';
const EDU_ADMIN_KEY   = 'eduadmin_admin';
const EDU_SESSION_KEY = 'eduadmin_session';

function eduGetUsers()   { return JSON.parse(localStorage.getItem(EDU_USERS_KEY) || '[]'); }
function eduSaveUsers(u) { localStorage.setItem(EDU_USERS_KEY, JSON.stringify(u)); }
function eduGetAdmin()   {
  return JSON.parse(localStorage.getItem(EDU_ADMIN_KEY) || '{"email":"admin@gmail.com","password":"1234","role":"admin"}');
}
function eduGetSession()    { return JSON.parse(sessionStorage.getItem(EDU_SESSION_KEY) || 'null'); }
function eduSetSession(u)   { sessionStorage.setItem(EDU_SESSION_KEY, JSON.stringify(u)); }
function eduClearSession()  { sessionStorage.removeItem(EDU_SESSION_KEY); }

/* ════════════════════════════════
   MODAL OPEN / CLOSE
════════════════════════════════ */
function openEduModal() {
  const session = eduGetSession();
  if (session) {
    if (session.role === 'admin') eduShowView('admin');
    else {
      const user = eduGetUsers().find(u => u.email === session.email);
      if (user) { eduShowFormateurView(user); }
      else { eduClearSession(); eduShowView('login'); }
    }
  } else {
    eduShowView('login');
  }
  document.getElementById('edu-modal-overlay').classList.add('show');
}

function closeEduModal() {
  document.getElementById('edu-modal-overlay').classList.remove('show');
  closeEduSubModal();
}

function handleEduOverlayClick(e) {
  if (e.target === document.getElementById('edu-modal-overlay')) closeEduModal();
}

/* ════════════════════════════════
   VIEWS
════════════════════════════════ */
function eduShowView(view) {
  ['login','admin','formateur'].forEach(v =>
    document.getElementById('edu-view-'+v).classList.add('hidden')
  );
  document.getElementById('edu-view-'+view).classList.remove('hidden');

  const badge = document.getElementById('edu-role-badge');
  if (view === 'admin')      { badge.textContent = 'Admin'; badge.style.background = 'rgba(56,189,248,0.15)'; badge.style.color = '#38bdf8'; }
  else if (view === 'formateur') { badge.textContent = 'Formateur'; badge.style.background = 'rgba(22,163,74,0.15)'; badge.style.color = '#16a34a'; }
  else { badge.textContent = '—'; }

  if (view === 'admin') eduRenderTable();
}

function eduShowFormateurView(user) {
  document.getElementById('edu-fmt-email').textContent = user.email;
  document.getElementById('edu-fmt-dept').textContent  = user.dept || 'N/A';
  eduShowView('formateur');
}

/* ════════════════════════════════
   AUTH
════════════════════════════════ */
function eduHandleLogin() {
  const email = document.getElementById('edu-login-email').value.trim();
  const pwd   = document.getElementById('edu-login-password').value;
  if (!email || !pwd) { eduToast('Remplissez tous les champs', 'error'); return; }

  const admin = eduGetAdmin();
  if (email === admin.email && pwd === admin.password) {
    eduSetSession({ email, role: 'admin' });
    eduShowView('admin');
    eduToast('Bienvenue, Administrateur !', 'success');
    return;
  }

  const user = eduGetUsers().find(u => u.email === email && u.password === pwd && u.role === 'formateur');
  if (user) {
    eduSetSession(user);
    eduShowFormateurView(user);
    eduToast('Connexion réussie', 'success');
    return;
  }

  eduToast('E-mail ou mot de passe incorrect', 'error');
}

function eduLogout() {
  eduClearSession();
  document.getElementById('edu-login-email').value = '';
  document.getElementById('edu-login-password').value = '';
  eduShowView('login');
  eduToast('Déconnecté', 'info');
}

/* ════════════════════════════════
   SIGNUP
════════════════════════════════ */
function eduHandleSignup() {
  const email = document.getElementById('edu-su-email').value.trim();
  const pwd   = document.getElementById('edu-su-pw').value;
  const dept  = document.getElementById('edu-su-dept').value;
  if (!email || !pwd || !dept) { eduToast('Remplissez tous les champs', 'error'); return; }
  if (pwd.length < 6) { eduToast('Mot de passe trop court', 'error'); return; }
  if (email === eduGetAdmin().email) { eduToast('E-mail déjà utilisé', 'error'); return; }
  const users = eduGetUsers();
  if (users.find(u => u.email === email)) { eduToast('E-mail déjà utilisé', 'error'); return; }
  users.push({ id:'u_'+Date.now(), email, password:pwd, role:'formateur', dept, createdAt:new Date().toISOString() });
  eduSaveUsers(users);
  closeEduSubModal();
  ['edu-su-email','edu-su-pw','edu-su-dept'].forEach(id => document.getElementById(id).value = '');
  eduToast('Compte créé ! Connectez-vous.', 'success');
}

/* ════════════════════════════════
   TABLE
════════════════════════════════ */
function eduRenderTable() {
  const q      = (document.getElementById('edu-search').value || '').toLowerCase();
  const users  = eduGetUsers().filter(u => u.role === 'formateur');
  const filter = users.filter(u =>
    u.email.toLowerCase().includes(q) || (u.dept||'').toLowerCase().includes(q)
  );

  const depts = new Set(users.map(u => u.dept).filter(Boolean));
  document.getElementById('edu-stat-total').textContent = users.length;
  document.getElementById('edu-stat-depts').textContent = depts.size;

  const tbody = document.getElementById('edu-tbody');
  const empty = document.getElementById('edu-empty');
  tbody.innerHTML = '';

  if (filter.length === 0) { empty.classList.remove('hidden'); return; }
  empty.classList.add('hidden');

  filter.forEach(u => {
    const tr = document.createElement('tr');
    const masked = '•'.repeat(Math.min(u.password.length, 8));
    tr.innerHTML = `
      <td>
        <div class="edu-email-cell">
          ${eduEsc(u.email)}<span>Formateur</span>
        </div>
      </td>
      <td>
        <span class="edu-pw-cell" onclick="eduRevealPw(this,'${eduEsc(u.password)}')"
          title="Cliquer pour voir">${masked}</span>
      </td>
      <td><span class="edu-dept-badge">${eduEsc(u.dept||'N/A')}</span></td>
      <td>
        <div class="edu-actions">
          <button class="edu-btn edu-btn-edit edu-btn-sm" onclick="openEduSubModal('edit','${u.id}')">
            ✏️ Modifier
          </button>
          <button class="edu-btn edu-btn-danger edu-btn-sm" onclick="openEduSubModal('delete','${u.id}','${eduEsc(u.email)}')">
            🗑️ Supprimer
          </button>
        </div>
      </td>`;
    tbody.appendChild(tr);
  });
}

function eduRevealPw(el, pw) {
  el.textContent = el.dataset.r === '1'
    ? (el.dataset.r='0', '•'.repeat(Math.min(pw.length,8)))
    : (el.dataset.r='1', pw);
}

/* ════════════════════════════════
   SUB-MODAL
════════════════════════════════ */
let eduDeleteId = null;

function openEduSubModal(type, id = '', email = '') {
  ['edu-sub-signup','edu-sub-form','edu-sub-confirm'].forEach(k =>
    document.getElementById(k).classList.add('hidden')
  );

  if (type === 'signup') {
    document.getElementById('edu-sub-signup').classList.remove('hidden');
  } else if (type === 'create') {
    document.getElementById('edu-sub-form-title').textContent = 'Créer un formateur';
    document.getElementById('edu-form-submit').textContent    = 'Créer';
    document.getElementById('edu-form-id').value = '';
    ['edu-form-email','edu-form-pw','edu-form-dept'].forEach(k => document.getElementById(k).value = '');
    document.getElementById('edu-sub-form').classList.remove('hidden');
  } else if (type === 'edit') {
    const user = eduGetUsers().find(u => u.id === id);
    if (!user) return;
    document.getElementById('edu-sub-form-title').textContent = 'Modifier le compte';
    document.getElementById('edu-form-submit').textContent    = 'Enregistrer';
    document.getElementById('edu-form-id').value    = id;
    document.getElementById('edu-form-email').value = user.email;
    document.getElementById('edu-form-pw').value    = user.password;
    document.getElementById('edu-form-dept').value  = user.dept || '';
    document.getElementById('edu-sub-form').classList.remove('hidden');
  } else if (type === 'delete') {
    eduDeleteId = id;
    document.getElementById('edu-confirm-email').textContent = email;
    document.getElementById('edu-sub-confirm').classList.remove('hidden');
  }

  document.getElementById('edu-submodal-overlay').classList.add('show');
}

function closeEduSubModal() {
  document.getElementById('edu-submodal-overlay').classList.remove('show');
}

function handleSubOverlayClick(e) {
  if (e.target === document.getElementById('edu-submodal-overlay')) closeEduSubModal();
}

function eduHandleFormSubmit() {
  const editId = document.getElementById('edu-form-id').value;
  const email  = document.getElementById('edu-form-email').value.trim();
  const pwd    = document.getElementById('edu-form-pw').value;
  const dept   = document.getElementById('edu-form-dept').value;

  if (!email || !pwd || !dept) { eduToast('Remplissez tous les champs', 'error'); return; }
  if (pwd.length < 6) { eduToast('Mot de passe trop court', 'error'); return; }
  if (email === eduGetAdmin().email) { eduToast('E-mail réservé admin', 'error'); return; }

  let users = eduGetUsers();
  if (users.find(u => u.email === email && u.id !== editId)) { eduToast('E-mail déjà utilisé', 'error'); return; }

  if (editId) {
    users = users.map(u => u.id === editId ? {...u, email, password:pwd, dept} : u);
    eduToast('Compte modifié', 'success');
  } else {
    users.push({ id:'u_'+Date.now(), email, password:pwd, role:'formateur', dept, createdAt:new Date().toISOString() });
    eduToast('Formateur créé', 'success');
  }
  eduSaveUsers(users);
  closeEduSubModal();
  eduRenderTable();
}

function eduConfirmDelete() {
  if (!eduDeleteId) return;
  eduSaveUsers(eduGetUsers().filter(u => u.id !== eduDeleteId));
  eduDeleteId = null;
  closeEduSubModal();
  eduRenderTable();
  eduToast('Compte supprimé', 'success');
}

/* ════════════════════════════════
   TOAST
════════════════════════════════ */
function eduToast(msg, type = 'info') {
  const icons = { success:'✅', error:'❌', info:'ℹ️' };
  const t = document.createElement('div');
  t.className = `edu-toast ${type}`;
  t.innerHTML = `<span>${icons[type]}</span><span>${msg}</span>`;
  document.getElementById('edu-toast-container').appendChild(t);
  setTimeout(() => {
    t.style.transition = 'opacity 0.3s';
    t.style.opacity = '0';
    setTimeout(() => t.remove(), 300);
  }, 3000);
}

/* ════════════════════════════════
   UTILITIES
════════════════════════════════ */
function eduEsc(s) {
  return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;')
    .replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
}

function eduTogglePw(inputId, btn) {
  const el = document.getElementById(inputId);
  const show = el.type === 'password';
  el.type = show ? 'text' : 'password';
  btn.innerHTML = show
    ? `<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
         <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
         <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
         <line x1="1" y1="1" x2="23" y2="23"/></svg>`
    : `<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
         <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
}
</script>

</body>
</html>