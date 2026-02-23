function TodoItem({ id, title, completed }) {
  return (
    <div>
      <div>
        <h3>{title}</h3>
        <p>ID : {id}</p>
        <p>status:{completed?"termine":"nom termine"}</p>
      </div>
    </div>
  );
}

export default TodoItem;

