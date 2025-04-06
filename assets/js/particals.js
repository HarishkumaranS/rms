particlesJS("particles-js", {
    particles: {
        number: { value: 100 },
        shape: { type: "circle" },
        color: { value: ["#ff5733", "#f4c542", "#28a745"] }, // Custom colors (orange, yellow, green)
        opacity: { value: 0.7 },
        size: { value: 4 },
        move: { speed: 2 },
        line_linked: {
            enable: true,
            color: "#ffffff", // Line color (white)
            opacity: 0.2,
        },
    },
    interactivity: {
        events: {
            onhover: { enable: true, mode: "repulse" },
        },
    },
});