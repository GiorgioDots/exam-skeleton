function onSelectAction(action) {
  const selectQueryDiv = document.getElementById('selectQueryDiv');
  const insertQueryDiv = document.getElementById('insertQueryDiv');
  selectQueryDiv.innerHTML = '';
  insertQueryDiv.innerHTML = '';
  insertQueryDiv.className = '';
  selectQueryDiv.className = '';
  if (action === 'query') {
    selectQueryDiv.innerHTML = `
      <select class="form-control" name="preselected_query" onchange="onChangeQuery(this.value)">
        <option value="insertOne">Insert One</option>
        <option value="query1">Query 1</option>
        <option value="query2">Query 2</option>
        <option value="query3">Query 3</option>
      </select>
    `;
    insertQueryDiv.innerHTML = `
      <input type="text" class="form-control" name="query" placeholder="Insert a query">
    `;
    insertQueryDiv.className = 'form-group';
    selectQueryDiv.className = 'form-group mr-sm-3';
  }
}

function onChangeQuery(action) {
  const insertQueryDiv = document.getElementById('insertQueryDiv');
  switch (action) {
    case 'query1':
      let query1 = `
        SELECT film.director_surname as 'Director Surname', actor.name as 'Actor Name', actor.surname as 'Actor Surname', actor.actor_id, interprets.character, COUNT(*) as times\n
        FROM interprets, actor, film\n
        WHERE\n
          actor.actor_id = interprets.actor_id_fk AND\n
          film.film_id = interprets.film_id_fk\n
        GROUP BY film.director_surname, actor.actor_id, interprets.character\n
        ORDER BY times DESC
      `;
      insertQueryDiv.innerHTML = `
        <input type="hidden" name="query" value="${query1}">
        <div class="p-3" style="white-space:pre-line; border: 1px solid #f4f4f4; background-color: #f0efed;">
          <h6>Query Description</h6>
          <p>For each director and actor, show the number of the director's films where the actor worked. Also show the character interpretated by the actor.</p>
          <code>${query1}</code>
        </div>
      `;
      break;
    case 'query2':
      let query2 = `
        SELECT film.director_surname, SUM(planned.takings) as 'All Takings'\n
        FROM film, planned\n
        WHERE film.film_id = planned.film_id_fk\n
        GROUP BY film.director_surname
      `;
      insertQueryDiv.innerHTML = `
        <input type="hidden" name="query" value="${query2}">
        <div class="p-3" style="white-space:pre-line; border: 1px solid #f4f4f4; background-color: #f0efed">
          <h6>Query Description</h6>
          <p>Show the total proceeds of the projection made by every single director.</p>
          <code>${query2}</code>
        </div>
      `;
      break;
    case 'query3':
      let query3 = `
        SELECT city, COUNT(*) As 'n. of cinemas'\n
        FROM cinema\n
        WHERE seats < 200\n
        GROUP BY city
      `;
      insertQueryDiv.innerHTML = `
        <input type="hidden" name="query" value="${query3}">
        <div class="p-3" style="white-space:pre-line; border: 1px solid #f4f4f4; background-color: #f0efed">
          <h6>Query Description</h6>
          <p>Show the number of the cinema which has less than 200 seats for every city.</p>
          <code>${query3}</code>
        </div>
      `;
      break;
    default:
      insertQueryDiv.innerHTML = `
        <input type="text" class="form-control" name="query" placeholder="Insert a query">
      `;
  }
}
