import TodoItem from "./TodoItem";

function TodoList() {

  const tasks = [
    { id: 1, title: "Apprendre React", completed: false },
    { id: 2, title: "Faire les exercices", completed: true },
    { id: 3, title: "Créer un mini projet", completed: false },
  ];

  return (
    <div>
      <h2>Mes Tâches :</h2>

      {tasks.map((task) => (
        <TodoItem
          key={task.id}
         
          title={task.title}
          completed={task.completed}
        />
      ))}
    </div>
  );
}

export default TodoList;
