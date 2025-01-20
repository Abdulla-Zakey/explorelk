<html>
    <head>
        <title>ExploreLK Tour Guide</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css?v=1.0">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="flexContainer">

            <?php include_once APPROOT.'\views\inc\tourGuideNavBar.php'; ?>

            <div class="body-container">
                <h1 class="heading">Set your availability</h1>
                <div class="form-section">
                    <form class="form-fields">
                        <label for="from-date">From</label>
                        <input type="date" placeholder="mm/dd/yyyy">
        
                        <label for="to-date">To</label>
                        <input type="date" placeholder="mm/dd/yyyy">
        
                        <label for="reason">Reason (optional)</label>
                        <input type="text" placeholder="Vacation, personal days, etc.">
        
                        <button class="add-period-btn">Add period</button>
                    </form>
        
                    <div class="calendar-section">
                        <div class="calendar">
                            <h3>December 2024</h3>
                            <table>
                                <thead>
                                    <tr>
                                        <th>SUN</th>
                                        <th>MON</th>
                                        <th>TUE</th>
                                        <th>WED</th>
                                        <th>THU</th>
                                        <th>FRI</th>
                                        <th>SAT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td><td></td><td></td><td></td><td>6</td><td>7</td><td>8</td>
                                    </tr>
                                    <tr>
                                        <td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td>
                                    </tr>
                                    <tr>
                                        <td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td>
                                    </tr>
                                    <tr>
                                        <td>23</td><td>24</td><td>25</td><td class="highlight">26</td><td>27</td><td>28</td><td>29</td>
                                    </tr>
                                    <tr>
                                        <td>30</td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        
                <div>
                    <h2 class="sub-heading">Upcoming Unavailability Periods</h2>
                    <table class="unavailability-table">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Reason</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Unavailability</td>
                                <td>Vacation</td>
                                <td>Dec 26, 2023</td>
                                <td>Dec 26, 2023</td>
                                <td>
                                    <button class="delete-btn"><i class="fa fa-trash fa-lg"></i></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>