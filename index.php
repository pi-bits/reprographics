<?php
header("Cache-Control: no-cache");
header("Pragma: no-cache");

include 'upload.php';
?>
<!DOCTYPE html>
<html>

<head>

    <title>The Hazeley Academy - Reprographics</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv='Pragma' content='no-cache'>
    <meta http-equiv='Expires' content='-1'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" media="all" href="http://www.thehazeleyacademy.com/wp-content/themes/hazeley/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <script src="main.js"></script>

</head>

<body>

    <div id="top">
        <div id="header">
            <div id="headerL">
                <a href="http://www.thehazeleyacademy.com"><img src="http://www.thehazeleyacademy.com/wp-content/themes/hazeley/images/logo.png" alt="The Hazeley Academy"></a>
            </div>
        </div>
    </div>

    <h1 style="text-align: center;">Reprographic Requirement Form</h1>
    <strong>
        <p style="text-align: center;">Please use this form to request printing or copying, etc</p>
    </strong>
    <section>

        <div class="container mt-3">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">

                    <div class="required row">
                        <div class="col-sm-2"></div>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form" enctype="multipart/form-data" id="requirmentForm" name="requirmentForm">
                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <label for="firstname" class="control-label">Name:</label>
                                <input type="text" class="form-control form-control-sm" id="firstname" placeholder="Enter First Name" name="firstname" value="<?php echo isset($_POST["firstname"]) ? $_POST["firstname"] : ''; ?>">
                                <span class="errorText"><?php echo $firstnameError; ?></span>
                            </div>

                        </div>

                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <label for="department" class="control-label">Budget/Department:</label>
                                <select name="department" class="form-control form-control-sm" id="department">
                                    <option value="">--Please select--</option>
                                    <option value="Administration" <?php if (isset($_POST["department"]) && $_POST["department"] == "Administration") print(" selected") ?>>Administration</option>
                                    <option value="Art" <?php if (isset($_POST["department"]) && $_POST["department"] == "Art") print(" selected") ?>>Art</option>
                                    <option value="BusinessStudies" <?php if (isset($_POST["department"]) && $_POST["department"] == "BusinessStudies") print(" selected") ?>>Business Studies</option>
                                    <option value="Catering" <?php if (isset($_POST["department"]) && $_POST["department"] == "Catering") print(" selected") ?>>Catering</option>
                                    <option value="Cover" <?php if (isset($_POST["department"]) && $_POST["department"] == "Cover") print(" selected") ?>>Cover</option>
                                    <option value="Creative" <?php if (isset($_POST["department"]) && $_POST["department"] == "Creative") print(" selected") ?>>Creative</option>
                                    <option value="Dance" <?php if (isset($_POST["department"]) && $_POST["department"] == "Dance") print(" selected") ?>>Dance</option>
                                    <option value="DropDownDay" <?php if (isset($_POST["department"]) && $_POST["department"] == "DropDownDay") print(" selected") ?>>Drop Down Day</option>
                                    <option value="Other" <?php if (isset($_POST["department"]) && $_POST["department"] == "Other") print(" selected") ?>>Other</option>
                                </select>
                                <span class="errorText"><?php echo $departmentError; ?></span>
                            </div>
                        </div>



                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <label for="printCopies" class="control-label">Number of Copies:</label>
                                <input class="form-control form-control-sm" type="number" name="printCopies" value="<?php echo isset($_POST["printCopies"]) ? $_POST["printCopies"] : ''; ?>" placeholder="Copies to Print">
                                <span class="errorText"><?php echo $printCopiesError; ?></span>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <label for="Dates" class="control-label">Date Required:</label>
                                <input class="form-control form-control-sm" type="date" id="Dates" value='<?php echo isset($_POST["Dates"]) ? $_POST["Dates"] : ''; ?>' onkeydown="return false" name="Dates" min="<?php echo date('Y-m-d') ?>" data-date-format="DD MMMM YYYY" >
                                <span class="errorText"><?php echo $printDateError; ?></span>

                            </div>
                        </div>

                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <label for="period" class="control-label">Period Required:</label>
                                <select name="period" class="form-control form-control-sm">
                                    <option value="">--Please select--</option>
                                    <option value="Period1" <?php if (isset($_POST["period"]) && $_POST["period"] == "Period1") print(" selected") ?>>Period1</option>
                                    <option value="Period2" <?php if (isset($_POST["period"]) && $_POST["period"] == "Period2") print(" selected") ?>>Period2</option>
                                    <option value="Break" <?php if (isset($_POST["period"]) && $_POST["period"] == "Break") print(" selected") ?>>Break</option>
                                    <option value="Period3" <?php if (isset($_POST["period"]) && $_POST["period"] == "Period3") print(" selected") ?>>Period3</option>
                                    <option value="Period4" <?php if (isset($_POST["period"]) && $_POST["period"] == "Period4") print(" selected") ?>>Period4</option>
                                    <option value="Period5" <?php if (isset($_POST["period"]) && $_POST["period"] == "Period5") print(" selected") ?>>Period5</option>
                                    <option value="Period6" <?php if (isset($_POST["period"]) && $_POST["period"] == "Period6") print(" selected") ?>>Period6</option>
                                </select>
                                <span class="errorText"><?php echo $periodError; ?></span>

                            </div>
                        </div>

                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <p class="form-check-label">Urgently Required :</p>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input form-control-sm" value="Yes" name="urgentlyRequired" <?php if (isset($_POST["urgentlyRequired"]) && $_POST["urgentlyRequired"] == "Yes") print(" checked") ?>>Yes
                                </div>

                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input form-control-sm" value="No" name="urgentlyRequired" <?php if (isset($_POST["urgentlyRequired"]) && $_POST["urgentlyRequired"] == "No") print(" checked") ?>>No
                                </div>

                                <div>
                                    <span class="errorText"><?php echo  $urgentlyRequiredError; ?></span>
                                </div>


                            </div>

                        </div>


                        <div class="form-group required row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-9">

                                <div class="card">
                                    <div class="card-header">
                                        <h6>Print Requirements</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-title">Standard prints will be double sided and black & white, If you need anything different from this please enter the specific details below.</p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Colour</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="Colour">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Size-A3</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="A3">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Size-A5</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="A5">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Stapled-Top Left</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="StapledTopLeft">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Stapled-Left Edge</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="StapledLeftEdge">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Hole Punched-Left x 4</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="HolePunchedLeft4">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Hole Punched-Left x 2</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="HolePunchedLeft2">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Booklet-A4</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="BookletA4">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Booklet-A5</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="BookletA5">
                                                </div>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class="required row">
                                                <div class="col-sm-9">
                                                    <label class="checkbox">Laminated</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="check_list[]" value="Laminated">
                                                </div>
                                            </div>

                                        </li>
                                    </ul>
                                </div>


                            </div>
                        </div>

                        <div class="form-group row" id="specialRequirementContainer">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <label for="specialRequirement" class="control-label">Special Requirements:</label>
                                <textarea class="form-control form-control-sm" rows="5" id="specialRequirement" name="specialRequirement"></textarea>

                                <strong><span class="help-block">Please list other requirements not listed already,such
                                        as
                                        colored paper/card,laminated,binding
                                        etc.</span>
                                </strong>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <label for="uploadDocument" class="control-label">Upload Document:</label>
                                <input type="file" name="uploadDocument" class="form-control-file border">
                                <div>
                                    <span class="errorText"><?php echo  $uploadDocumentError; ?></span>
                                </div>

                            </div>

                        </div>


                        <div class="form-group row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <input type="submit" id="submit" name="submit" class="btn btn-primary btn-block" value="Submit">
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </section>

    <footer></footer>
</body>

</html>