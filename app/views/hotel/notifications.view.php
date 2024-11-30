<?php 
    include_once APPROOT.'/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php';
?>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 40;
            padding: 20;
        }
        .container {
            width: 78%;
            margin: 220px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: absolute;
            top: 200;
            left: 280px;
            height: 70vh;
            
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #f0f4f8;
            border-bottom: 1px solid #ddd;
        }
        .header button {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
        }
        .header button.active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .header input {
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 200px;
        }
        .header select {
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .table-header {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #e0e7ef;
            border-bottom: 1px solid #ddd;
        }
        .table-header input {
            margin-right: 10px;
        }
        .table-row {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }
        .table-row:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table-row input {
            margin-right: 10px;
        }
        .table-row .status {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #007bff;
            margin-right: 10px;
        }
        .table-row .status.read {
            background-color: transparent;
        }
        .table-row .user {
            flex: 1;
        }
        .table-row .type {
            flex: 2;
        }
        .table-row .mention {
            flex: 1;
            text-align: right;
        }
        .table-row .time {
            flex: 1;
            text-align: right;
        }
        .table-row .icon {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <button class="active">All</button>
                <button>Unread</button>
            </div>
            <input type="text" placeholder="Filter notifications">
            <select>
                <option>Group by: Date</option>
            </select>
        </div>
        <div class="table-header">
            <input type="checkbox">
            <span>Select all</span>
        </div>
        <div class="table-row">
            <input type="checkbox">
            <div class="status"></div>
            <div class="user">Admin</div>
            <div class="type">Confirmation of subscription</div>
            <div class="mention">mention</div>
            <div class="time">1 day ago</div>
            <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="table-row">
            <input type="checkbox">
            <div class="status read"></div>
            <div class="user">Thags</div>
            <div class="type">Appreciation</div>
            <div class="mention">mention</div>
            <div class="time">2 weeks ago</div>
            <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="table-row">
            <input type="checkbox">
            <div class="status"></div>
            <div class="user">Sarma</div>
            <div class="type">Confirmation of subscription</div>
            <div class="mention">mention</div>
            <div class="time">1 day ago</div>
            <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="table-row">
            <input type="checkbox">
            <div class="status read"></div>
            <div class="user">Zakey</div>
            <div class="type">Appreciation</div>
            <div class="mention">mention</div>
            <div class="time">2 weeks ago</div>
            <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="table-row">
            <input type="checkbox">
            <div class="status"></div>
            <div class="user">Jabir</div>
            <div class="type">Confirmation of subscription</div>
            <div class="mention">mention</div>
            <div class="time">1 day ago</div>
            <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="table-row">
            <input type="checkbox">
            <div class="status read"></div>
            <div class="user">Niro</div>
            <div class="type">Appreciation</div>
            <div class="mention">mention</div>
            <div class="time">2 weeks ago</div>
            <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="table-row">
            <input type="checkbox">
            <div class="status"></div>
            <div class="user">Nive</div>
            <div class="type">Confirmation of subscription</div>
            <div class="mention">mention</div>
            <div class="time">1 day ago</div>
            <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="table-row">
            <input type="checkbox">
            <div class="status read"></div>
            <div class="user">Jathu</div>
            <div class="type">Appreciation</div>
            <div class="mention">mention</div>
            <div class="time">2 weeks ago</div>
            <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="table-row">
            <input type="checkbox">
            <div class="status"></div>
            <div class="user">Vijay</div>
            <div class="type">Confirmation of subscription</div>
            <div class="mention">mention</div>
            <div class="time">1 day ago</div>
            <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="table-row">
            <input type="checkbox">
            <div class="status read"></div>
            <div class="user">Surya</div>
            <div class="type">Appreciation</div>
            <div class="mention">mention</div>
            <div class="time">2 weeks ago</div>
            <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        
       
    </div>
</body>
<script>
  // Get all buttons and table rows
  const buttons = document.querySelectorAll('.header button');
  const tableRows = document.querySelectorAll('.table-row');

  // Add event listeners to buttons
  buttons.forEach((button) => {
    button.addEventListener('click', (e) => {
      // Get the button's text content
      const buttonText = e.target.textContent;

      // Filter table rows based on button text
      tableRows.forEach((tableRow) => {
        if (buttonText === 'All') {
          tableRow.style.display = 'flex';
        } else if (buttonText === 'Unread') {
          const statusDiv = tableRow.querySelector('.status');
          if (statusDiv.classList.contains('read')) {
            tableRow.style.display = 'none';
          } else {
            tableRow.style.display = 'flex';
          }
        }
      });
    });
  });

  // Add event listener to filter input
  const filterInput = document.querySelector('.header input[type="text"]');
  filterInput.addEventListener('input', (e) => {
    const filterText = e.target.value.toLowerCase();
    tableRows.forEach((tableRow) => {
      const userDiv = tableRow.querySelector('.user');
      const typeDiv = tableRow.querySelector('.type');
      const mentionDiv = tableRow.querySelector('.mention');
      const timeDiv = tableRow.querySelector('.time');

      const userText = userDiv.textContent.toLowerCase();
      const typeText = typeDiv.textContent.toLowerCase();
      const mentionText = mentionDiv.textContent.toLowerCase();
      const timeText = timeDiv.textContent.toLowerCase();

      if (
        userText.includes(filterText) ||
        typeText.includes(filterText) ||
        mentionText.includes(filterText) ||
        timeText.includes(filterText)
      ) {
        tableRow.style.display = 'flex';
      } else {
        tableRow.style.display = 'none';
      }
    });
  });
</script>
</html>