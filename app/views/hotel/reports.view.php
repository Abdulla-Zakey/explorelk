<?php 
    include_once APPROOT.'/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php'; // This will include the header content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report an Issue</title>
    <style>
        body {
            font-family: 'poppins';
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        main {
            position: absolute; /* Changed to relative for proper layout */
            margin-top: 0px; /* Adjust margin to avoid overlap with header */
        }

        .container {
            background: white;
            margin-top: 215px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* margin: 20px; Adjusted margin */
            max-width: 800px; /* Set a max width for better layout */
            margin-left: auto; /* Center the container */
            margin-right: auto; /* Center the container */
        }

        /* Styles from hotelhead.php */
        .image-container {
            display: flex;
            justify-content: center;
            width: calc(100% - 3rem);
            margin-left: 1.5rem;
            margin-right: 1.5rem;
            position: relative;
        }
        .image-container img {
            width: 100%;
            height: 175px;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }
        .title {
            font-size: 36px;
            font-weight: bold;
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            z-index: 1;
        }
        .date {
            font-size: 18px;
            color: #4b2e2e;
            margin-top: 10px;
            text-align: center; /* Center the date */
        }

        /* Form styles */
        .form-group {
            margin-bottom: 15px;
        }
       
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 100px;
        }

        .word-count {
            font-size: 12px;
            color: #666;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
        }

        .btn-submit {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-cancel {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        .btn-cancel:hover {
            background-color: #c82333;
        }
        .priority-group {
    display: flex;
    gap: 20px;
    margin: 10px 0;
}

.priority-option {
    display: flex;
    align-items: center;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
}

.priority-low { background-color: #e8f5e9; }
.priority-medium { background-color: #fff3e0; }
.priority-high { background-color: #ffebee; }

.form-group {
    margin: 20px 0;
}

.priority-label {
    font-weight: bold;
    margin-bottom: 10px;
    display: block;
    color: #333;
}

.priority-options {
    display: flex;
    gap: 20px;
    align-items: center;
}

.priority-item {
    display: flex;
    align-items: center;
    padding: 8px 16px;
    background-color: #f5f5f5;
    border-radius: 20px;
    transition: all 0.3s ease;
}

.priority-item:hover {
    background-color: #e0e0e0;
    cursor: pointer;
}

.priority-item input[type="radio"] {
    margin-right: 8px;
}

.priority-item label {
    cursor: pointer;
    font-size: 14px;
}

/* Custom colors for different priority levels */
.priority-item:has(input[value="low"]:checked) {
    background-color: #e8f5e9;
    color: #2e7d32;
}

.priority-item:has(input[value="medium"]:checked) {
    background-color: #fff3e0;
    color: #f57c00;
}

.priority-item:has(input[value="high"]:checked) {
    background-color: #ffebee;
    color: #c62828;
}

header h1 {
    margin-bottom: 10px;  /* Adds space below the h1 tag */
    text-align: center;
}

header h3 {
    margin-top: 10px;     /* Adds space above each h3 tag */
    text-align: center;
}

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
</head>
<body>
    <main>
        <div class="container">
            <header>
                <h1>Report an Issue</h1>
                <h3>Let us know about any issues or concerns you are facing.</h3>
                <h3> We're here to help!</h3>
            </header>
            
            <form id="reportForm">
                <div class="form-group">
                    <label for="category">Issue Category</label>
                    <select id="category" required>
                        <option value="">Select a category</option>
                        <option value="technical">Technical Issue</option>
                        <option value="payment">Payment Problem</option>
                        <option value="booking">Booking Discrepancy</option>
                        <option value="feedback">Feedback/Suggestions</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" placeholder="Enter a brief title for your report" required>
                </div>
                  <div class="form-group">
                      <label for="description">Description</label>
                      <textarea id="description" maxlength="500" placeholder="Provide a detailed description of the issue or concern..." required></textarea>
                      <div class="word-count">
                          Characters remaining: <span id="charCount">500</span> | Words: <span id="wordCount">0</span>
                      </div>
                  </div>
                <div class="form-group">
                    <label for="fileUpload">Attach Supporting Files (Optional)</label>
                    <input type="file" id="fileUpload" accept=".png,.jpg,.pdf,.doc,.docx" multiple>

                </div>

                <div class="form-group">
                    <label for="email">Your Email Address</label>
                    <input type="email" id="email" value="owner@example.com" readonly>
                </div>

                <div class="form-group">
    <label class="priority-label">Priority Level</label>
    <div class="priority-options">
        <div class="priority-item">
            <input type="radio" id="low" name="priority" value="low">
            <label for="low">Low</label>
        </div>
        <div class="priority-item">
            <input type="radio" id="medium" name="priority" value="medium">
            <label for="medium">Medium</label>
        </div>
        <div class="priority-item">
            <input type="radio" id="high" name="priority" value="high">
            <label for="high">High</label>
        </div>
    </div>
</div>


                <div class="form-actions">
                    <button type="submit" class="btn-submit">Submit Report</button>
                    <button type="button" class="btn-cancel" onclick="cancelReport()">Cancel</button>
                </div>
            </form>
        </div>
    </main>
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              const form = document.getElementById('reportForm');
            
              form.addEventListener('submit', function(event) {
                  event.preventDefault();
                
                  // Get form values
                  const category = document.getElementById('category').value;
                  const subject = document.getElementById('subject').value;
                  const description = document.getElementById('description').value;
                
                  // Basic validation
                  if (!category || !subject || !description) {
                      alert('Please fill in all required fields');
                      return;
                  }
                
                  // Show success message
                  alert('Your report was submitted successfully! We will review it shortly.');
                
                  // Reset all form fields
                  form.reset();
                
                  // Reset character and word counters
                  document.getElementById('charCount').textContent = '500';
                  document.getElementById('wordCount').textContent = '0';
              });
          });

          function submitForm() {
              const submitButton = document.querySelector('.btn-submit');
              submitButton.disabled = true;
              submitButton.innerHTML = '<span class="spinner"></span> Submitting...';
            
              // Simulate API call with a nice-looking popup
              setTimeout(() => {
                  submitButton.disabled = false;
                  submitButton.innerHTML = 'Submit Report';
                
                  Swal.fire({
                      title: 'Success!',
                      text: 'Your report was submitted successfully! We will review it shortly.',
                      icon: 'success',
                      confirmButtonText: 'OK'
                  });
                
                  document.getElementById('reportForm').reset();
              }, 2000);
          }

          function cancelReport() {
              document.getElementById('reportForm').reset();
          }

          document.getElementById('description').addEventListener('input', function() {
              const wordCount = this.value.split(/\s+/).filter(function(word) {
                  return word.length > 0;
              }).length;
              document.getElementById('wordCount').textContent = wordCount;
          });

          function formatDate(date) {
              const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
              return date.toLocaleDateString(undefined, options);
          }

          const today = new Date();
          const formattedDate = formatDate(today);
          document.getElementById('current-date').textContent = formattedDate;
      </script>
  </body>
</html>