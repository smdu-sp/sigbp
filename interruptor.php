<td style='color: red; font-weight: bold; text-align: right, maxWidth: 10px'>
  <div class="switch__container">
    <input id="switch-shadow" class="switch switch--shadow" type="checkbox">
    <label for="switch-shadow"></label>
  </div>
</td>";

<style>
  /* Estilo iOS */
  .switch__container {
    margin: 30px auto;
    width: 120px;
  }

  .switch {
    visibility: hidden;
    position: absolute;
    margin-left: -9999px;
  }

  .switch+label {
    display: block;
    position: relative;
    cursor: pointer;
    outline: none;
    user-select: none;
  }

  .switch--shadow+label {
    padding: 2px;
    width: 120px;
    height: 60px;
    background-color: #dddddd;
    border-radius: 60px;
  }

  .switch--shadow+label:before,
  .switch--shadow+label:after {
    display: block;
    position: absolute;
    top: 1px;
    left: 1px;
    bottom: 1px;
    content: "";
  }

  .switch--shadow+label:before {
    right: 1px;
    background-color: #f1f1f1;
    border-radius: 60px;
    transition: background 0.4s;
  }

  .switch--shadow+label:after {
    width: 62px;a
    background-color: #fff;
    border-radius: 100%;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    transition: all 0.4s;
  }

  .switch--shadow:checked+label:before {
    background-color: #8ce196;
  }

  .switch--shadow:checked+label:after {
    transform: translateX(60px);
  }

  /* Estilo Flat */
  .switch--flat+label {
    padding: 2px;
    width: 120px;
    height: 60px;
    background-color: #dddddd;
    border-radius: 60px;
    transition: background 0.4s;
  }

  .switch--flat+label:before,
  .switch--flat+label:after {
    display: block;
    position: absolute;
    content: "";
  }

  .switch--flat+label:before {
    top: 2px;
    left: 2px;
    bottom: 2px;
    right: 2px;
    background-color: #fff;
    border-radius: 60px;
    transition: background 0.4s;
  }

  .switch--flat+label:after {
    top: 4px;
    left: 4px;
    bottom: 4px;
    width: 56px;
    background-color: #dddddd;
    border-radius: 52px;
    transition: margin 0.4s, background 0.4s;
  }

  .switch--flat:checked+label {
    background-color: #8ce196;
  }

  .switch--flat:checked+label:after {
    margin-left: 60px;
    background-color: #8ce196;
  }
</style>