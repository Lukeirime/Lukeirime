<?php

$employer = $employerRegistry->getCurrentlyLoggedInEmployer();

?>
<!DOCTYPE html>
<html>
    <body style="max-width: 1200px;margin: auto;">
        <nav style="background: bisque;padding: 25px;">
            <h2 style="display: flex;justify-content: space-around;">
                <a href="/">Assignments portal</a>
            </h2>
            <div style="display: flex;justify-content: space-around;">
                    <div>
                        <a href="/assignment/assignments">Assignments</a>
                    </div>
                    <div>
                        <a href="/archive">Archive</a>
                    </div>
            </div>
        </nav>
    </body>
</html>