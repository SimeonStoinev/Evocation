<div id="editRecord" style="display:none;">
    <h3 style="text-align: center;">Редактирайте</h3>

    <hr>

    <label for="inputTitle">Заглавие:</label>
    <input class="input-lg" id="inputTitle" type="text" name="title">

    <br>

    <input class="module" type="hidden" value="{{ $module }}">
    <button class="btn-success" type="button" onclick="editRecord($(this))">Редактирай</button>
    <button class="btn-danger" type="button" onclick="closeModal()">Откажи</button>
</div>

<div id="createRecord" style="display:none;">
    <h3 style="text-align: center;">Добави</h3>

    <hr>

    <label for="inputTitle">Заглавие:</label>
    <input class="input-lg" id="inputTitle" type="text" name="title">

    <br>

    <input class="module" type="hidden" value="{{ $module }}">
    <button class="btn-success" type="button" onclick="createRecord($(this))">Създай</button>
    <button class="btn-danger" type="button" onclick="closeModal()">Откажи</button>
</div>

<div id="deleteRecord" style="display:none;">
    <h3 style="text-align: center;">Изтрий</h3>

    <hr>

    <label style="margin-top: 3%;">Сигурни ли сте, че искате да изтриете записа?</label>

    <br>

    <input class="module" type="hidden" value="{{ $module }}">
    <button class="btn-success" type="button" onclick="deleteRecord(this)">Изтрий</button>
    <button class="btn-danger" type="button" onclick="closeModal()">Откажи</button>
</div>