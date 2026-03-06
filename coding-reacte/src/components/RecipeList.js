import React from "react";

function RecipeList({ recipes, onDelete, onEdit }) {
  return React.createElement(
    "table",
    { border: 1, width: "100%" },
    React.createElement(
      "tbody",
      null,
      recipes.map(recipe =>
        React.createElement(
          "tr",
          { key: recipe.id },
          React.createElement("td", null, recipe.name),
          React.createElement("td", null, recipe.cuisine),
          React.createElement(
            "td",
            null,
            recipe.ingredients.slice(0, 3).join(", ")
          ),
          React.createElement(
            "td",
            null,
            React.createElement(
              "button",
              { onClick: () => onEdit(recipe) },
              "Modifier"
            ),
            React.createElement(
              "button",
              { onClick: () => onDelete(recipe.id) },
              "Supprimer"
            )
          )
        )
      )
    )
  );
}

export default RecipeList;
