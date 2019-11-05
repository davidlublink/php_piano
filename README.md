# php_piano
A piano, in PHP.

**This project is abandoned. PHP lacks ioctl, read and write commands which are essential for interacting with i2c.**

This project will use MCP23017 chips combined with a raspberry pi to scan an 88 key ( 178 button ) matrix keyboard and will pass the information to a synthesizer ( likely fluidsynth ) which will generate the sounds we want.


Goal : Replace main board in a Roland 230 piano with a raspberry pi and have it behave the same way.





Installation instructions : 

 Still no instructions

Notes : 
The I2C class currently represents a massive bottle neck ( because I am invoking shell_exec( i2c[sg]et ) ), because it is so slow I can only scan the 4x4 keyboard 1 per second. I will need to optimize the code. If I rewrite I2C class to interface directly with /dev/i2c-* I should be able to read/write faster.

The fastest piano player on record can play 20 notes per second per hand ( or 40 notes per second ).
There are 88 notes on the keyboard.
Fluid synth expects the time as an unsigned 7 bit integer ( 127 ).

This means I need to scan the entire keyboard at least 127 times per note playable per second ( 40 ). So less than 5khz scanning and I will not be able to run the keyboard properly.

I would like to use interrupts in this project, but I have no idea how they work, but I suspect I will need to write a kernel module in order to have complete control over interrupts.
