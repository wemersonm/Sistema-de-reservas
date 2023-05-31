function showOptions(select) {
  for (i = 8; i < 20; i++) {
    select.innerHTML += "<option value=>" + i + ":00" + "</option>";
    for (j = 0; j < 1; j++) {
      select.innerHTML += "<option>" + i + ":30" + "</option>";
    }
  }
  select.innerHTML += "<option>20:00</option>";
}
