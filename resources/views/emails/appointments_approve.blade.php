<h2>Hi {{ $appointment->user->lname }} {{ $appointment->user->fname }},</h2>
<p>Your appointment has been <strong>approved</strong> by {{ $appointment->upcycler->lname }}.</p>

<p><strong>Appointment Details:</strong></p>
<ul>
  <li>Type: {{ $appointment->apptype }}</li>
  <li>Date: {{ $appointment->appdate }}</li>
  <li>Contact: {{ $appointment->contactnumber }}</li>
</ul>

<p>Thank you for choosing our upcycling service!</p>
<p>Best regards, </p>
<p>The Upcycling Team</p>
{{-- 
Must modify this email template to include the appointment details and the upcycler's name. --}}