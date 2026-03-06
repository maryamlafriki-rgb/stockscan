function PersonalInfo({ data, onChange }) {
  return (
    <div>
      <h3>Informations personnelles</h3>

      <input
        type="text"
        placeholder="Nom"
        value={data.nom}
        onChange={(e) => onChange("nom", e.target.value)}
      />
      <br/><br/>
      <input
        type="text"
        placeholder="Prénom"
        value={data.prenom}
        onChange={(e) => onChange("prenom", e.target.value)}
      />
<br/><br/>
      <input
        type="email"
        name="email"
        placeholder="Email"
        value={data.email}
        onChange={(e) => onChange("email", e.target.value)}
      />
    </div>
  );
}

export default PersonalInfo;
