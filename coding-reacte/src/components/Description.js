function Description({ data, onChange }) {
  return (
    <div>
      <h3>Description</h3>
      <textarea
        value={data.description}
        onChange={(e) => onChange("description", e.target.value)}
      />
    </div>
  );
}

export default Description;

