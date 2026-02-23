function Preferences({ data, onChange, onCheckbox }) {
  return (
    <div>
      <h3>Préférences</h3>

      <p>Genre :</p>
      <label>
        <input
          type="radio"
          name="genre"
          value="Homme"
          checked={data.genre === "Homme"}
          onChange={(e) => onChange("genre", e.target.value)}
        />
        Homme
      </label>

      <label>
        <input
          type="radio"
          name="genre"
          value="Femme"
          checked={data.genre === "Femme"}
          onChange={(e) => onChange("genre", e.target.value)}
        />
        Femme
      </label>

      <p>Langues parlées :</p>
      <label>
        <input
          type="checkbox"
          checked={data.langues.includes("Français")}
          onChange={() => onCheckbox("Français")}
        />
        Français
      </label>

      <label>
        <input
          type="checkbox"
          checked={data.langues.includes("Arabe")}
          onChange={() => onCheckbox("Arabe")}
        />
        Arabe
      </label>

      <label>
        <input
          type="checkbox"
          checked={data.langues.includes("Anglais")}
          onChange={() => onCheckbox("Anglais")}
        />
        Anglais
      </label>
    </div>
  );
}
export default Preferences;  
