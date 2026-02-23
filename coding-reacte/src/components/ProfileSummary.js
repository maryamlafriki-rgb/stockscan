function ProfileSummary({ data }) {
  return (
    <div>
      <h3>Résumé du Profil</h3>
      <p><b>Nom :</b> {data.nom}</p>
      <p><b>Prénom :</b> {data.prenom}</p>
      <p><b>Email :</b> {data.email}</p>
      <p><b>Genre :</b> {data.genre}</p>
      <p><b>Langues :</b> {data.langues.join(", ")}</p>
      <p><b>Description :</b> {data.description}</p>
    </div>
  );
}

export default ProfileSummary;
