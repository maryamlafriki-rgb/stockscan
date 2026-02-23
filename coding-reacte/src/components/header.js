import menuIcon from "../assets/menu.svg";

function Header() {
  return (
    <header style={{
      display: "flex",
      justifyContent: "space-between",
      alignItems: "center",
      padding: "10px 20px",
      backgroundColor: "#f2f2f2"
    }}>
      <img
        src="/cmc-logo.png"
        alt="CMC Logo"
        style={{ width: "120px" }}
      />

      <img
        src={menuIcon}
        alt="Menu"
        style={{ width: "30px", cursor: "pointer" }}
      />
    </header>
  );
}

export default Header;
