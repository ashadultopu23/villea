<div class="step-circle_box">

    <div class="inner_circle">
        <svg viewBox="0 0 100 100">
            <circle class="progress-bar-background" cx="50" cy="50" r="45" />
            <circle class="progress-bar-fill" cx="50" cy="50" r="45" />
        </svg>

        <?php if (!empty($settings['label'])) :   ?>
            <p><?php echo esc_html($settings['label']) ?></p>
        <?php endif ?>
        <h2>
            <span class="current-count-step">
                <?php echo esc_html($settings['current_step']) ?>
            </span>
            <span class="count-separator">
                <?php echo esc_html("/", "tp-elements") ?>
            </span>
            <span class="total-count-step">
                <?php echo esc_html($settings['total_step']) ?>
            </span>
        </h2>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stepsCountBox = document.querySelectorAll(".step-count-box");
        const currentStepEl = document.querySelector(".current-count-step");

        // circular progress bar animation
        const circle = document.querySelector(".progress-bar-fill");
        const circumference = 2 * Math.PI * 45;
        circle.style.strokeDasharray = `0 ${circumference}`;

        if (stepsCountBox && currentStepEl) {
            function updateStepIndicator() {
                let currentStep = 0;
                stepsCountBox.forEach((step, index) => {
                    const rect = step.getBoundingClientRect();
                    if (rect.top <= window.innerHeight / 2) {
                        currentStep = index + 1;
                        const progress = currentStep / <?php echo esc_js($settings['total_step']); ?>;
                        const dashOffset = circumference * (1 - progress);
                        circle.style.strokeDasharray = `${circumference - dashOffset} ${circumference}`;
                    }
                });
                currentStepEl.textContent = String(currentStep).padStart(2, "0");
            }
            window.addEventListener("scroll", updateStepIndicator);
            updateStepIndicator();

        }
    });
</script>