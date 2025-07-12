<h2>Hello {{ $appointment->user->fname }} {{ $appointment->user->lname }},</h2>

<p>We’re pleased to inform you that your appointment has been <strong>approved</strong> by <strong>{{ $appointment->upcycler->fname }} {{ $appointment->upcycler->lname }}</strong>, your selected upcycler.</p>

<p><strong>Appointment Summary:</strong></p>
<ul>
  <li><strong>Service Type:</strong> {{ $appointment->apptype }}</li>
  <li><strong>Date & Time:</strong> {{ \Carbon\Carbon::parse($appointment->appdate)->format('F j, Y \a\t g:i A') }}</li>
  <li><strong>Contact Number:</strong> {{ $appointment->contactnumber }}</li>
</ul>

<p>Please make sure to arrive on time for your appointment to ensure a smooth and efficient service.</p>

<p>If you have any questions or need to make changes to your appointment, please feel free to contact us through our official platform or reach out directly to your upcycler.</p>

<p>Thank you for trusting our upcycling service. We’re excited to help you transform your items in a more sustainable way!</p>

<p>Warm regards,</p>
<p><strong>The Upcycling Team</strong></p>

<hr>

<p style="font-size: 0.9em; color: #666;">
This is an automated message. Please do not reply to this email. For inquiries, contact us through our website or support channels.
</p>
