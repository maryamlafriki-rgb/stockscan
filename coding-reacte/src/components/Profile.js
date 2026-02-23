import { useState } from "react";
import PersonalInfo from "./PersonalInfo";
import Preferences from "./Preferences";
import Description from "./Description";
import ProfileSummary from "./ProfileSummary";

function Profile() {
  const [profileData, setProfileData] = useState({
    nom: "",
    prenom: "",
    email: "",
    genre: "",
    langues: [],
    description: ""
  });

  const [submitted, setSubmitted] = useState(false);

  const handleChange = (name, value) => {
    setProfileData({ ...profileData, [name]: value });
  };

  const handleCheckbox = (langue) => {
    setProfileData((prev) => ({
      ...prev,
      langues: prev.langues.includes(langue)
        ? prev.langues.filter((l) => l !== langue)
        : [...prev.langues, langue]
    }));
    
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    setSubmitted(true);
  };

  return (
    <div>
      <h2>Profil Utilisateur</h2>

      {!submitted ? (
        <form onSubmit={handleSubmit}>
          <PersonalInfo data={profileData} onChange={handleChange} />
          <Preferences
            data={profileData}
            onChange={handleChange}
            onCheckbox={handleCheckbox}
          />
          <Description data={profileData} onChange={handleChange} />

          <button type="submit">Submit</button>
        </form>
      ) : (
        <>
          <ProfileSummary data={profileData} />
          <button onClick={() => setSubmitted(false)}>Modifier</button>
        </>
      )}
    </div>
  );
}

export default Profile;
