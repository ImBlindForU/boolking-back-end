const  firstTime = localStorage.getItem("first_time");
if(!firstTime) {
    // first time loaded!
    console.log(1);
    localStorage.setItem("first_time","1");
    const timeline = gsap.timeline({defaults: {duration: 1, }});
    timeline
    .from("#nav-welcome",{ y: '-100%',ease: " Power4.easeOut",})
    .from(".nav-link",{  opacity: 0, stagger: .6})
    .from("#container-welcome",{  opacity: 0, stagger: .6})
    .from("#logo-welcome", { opacity: 0, ease: "power2.in"}, 1)
    .from("#h1-welcome", { x:  "-100%", ease: "power2.in"}, 1)
    .from("#content-welcome", {  y: "-100%", ease: "power2.in"}, "<.5")
}