<body>

	<div class="container">
		
	 <form id="lisa-vorm2" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">

        <input type="hidden" name="action" value="add">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

        <p id="peida-nupp2">
            <button type="button">X</button>
        </p>

        <table>
            <tr>
                <td>Nimetus</td>
                <td>
                    <input type="text" id="nimetus" name="nimetus">
                </td>
            </tr>
            <tr>
                <td>Kogus</td>
                <td>
                    <input type="number" id="kogus" name="kogus">
                </td>
            </tr>
        </table>

        <p>
            <button type="submit">Lisa kirje</button>
        </p>

    </form>

    <table id="ladu2" border="1">
        <thead>
            <tr>
                <th>Nimetus</th>
                <th>Kogus</th>
                <th>Tegevused</th>
            </tr>
        </thead>

        <tbody>

        <?php
        // koolon tsükli lõpus tähendab, et tsükkel koosneb HTML osast
        foreach (model_load($page) as $rida): ?>

            <tr>
                <td>
                    <?=
                        // vältimaks pahatahtlikku XSS sisu, kus kasutaja sisestab õige
                        // info asemel <script> tag'i, peame tekstiväljundis asendama kõik HTML erisümbolid
                        htmlspecialchars($rida['nimetus']);
                    ?>
                </td>
                <td>
                    <form method="post" action="<?= $_SERVER['PHP_SELF'];?>">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'];?>">
                        <input type="hidden" name="id" value="<?= $rida['id'];?>">

                        <input type="number" style="width: 5em; text-align: right;" name="kogus" value="<?= $rida['kogus']; ?>">
                        <button type="submit">Uuenda</button>
                    </form>
                </td>
                <td>

                    <form method="post" action="<?= $_SERVER['PHP_SELF'];?>">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <input type="hidden" name="id" value="<?= $rida['id']; ?>">
                        <button type="submit">Kustuta rida</button>
                    </form>

                </td>
            </tr>

        <?php endforeach; ?>

        </tbody>
    </table>

    <p id="lehekylg2">
        <a href="<?= $_SERVER['PHP_SELF']; ?>?page=<?= $page - 1; ?>">
            Eelmine lehekülg
        </a>
        |
        <a href="<?= $_SERVER['PHP_SELF']; ?>?page=<?= $page + 1; ?>">
            Järgmine lehekülg
        </a>
    </p>
	
	</div>

    <script src="ladu.js"></script>
</body>