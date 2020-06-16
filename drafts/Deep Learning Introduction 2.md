[//]: # (TITLE: Deep Learning Introduction Part 2: Entropy and the Cost Function)
[//]: # (DATE: 2020-07-22)
[//]: # (TAGS: Artificial Intelligence, Deep Learning, Neural Networks)

This is part 2 of the blog series on the introduction on deep learning.
For part 1 check: https://arentvankorlaar.nl/post/Deep%2offLearning%2offIntroduction%2offon.

In this second part we will first dive a bit (more than one bit actually) into entropy, and afterwards explain what the cost function of a neural network is.

# Entropy

**Entropy** is a measure with which the amount of information can be quantified. It is a cornerstone of information theory and very fundamentall to much of science in general. The basic intuition behind entropy is that events that are likely to occur do not contain alot of information, whereas events that are unlikely to occur contain alot of information. In this way,
entropy can be also seen as a measure of uncertainty: the higher the uncertainty, the higher the entropy. 

In order to explain this using an example, suppose you had a switch with 2 settings: on or off. At any time the switch can only be in one of these two settings. How many questions do you need to know the current setting of the switch? The answer is: exactly one. Why? You only need to ask on yes/no question: 'is the switch on?'. Now suppose we set the switch at a random setting, how much uncertainty is there of its position? 50% uncertainty,
because the setting can either be 'on', or 'off'.

The formula for entropy is given as:

equation

Now using this formula and filling in a probability of 0.5 yields:

```python
import math

math.log2(0.5) = 1
```
Using the total number of possibilities,
instead of the probability yields:

```python
import math

-math.log2(1/2) = 1
```

Now suppose we had 3 of these switches. How many yes/no questions would you need now to know the exact setting of all the switches? Now you need 3 questions: Is the first switch on? Is the second switch on? Is the third switch on? Now the interesting thing is that if we only had one switch, we had 2 possible settings: on or off. However, now that we have 3 switches, our switches in total have 8 different possible settings:
```
off off off
off off on
off on off
off on on
on off off
on off on
on on off
on on on
```

Using our formula for entropy:

```python
import math

-math.log2(1/8) = 3
math.log2(8) = 3
```

So as you can see the entropy increases when there is a higher number of
possible states, and also a higher uncertainty.

# Cost function

This knowledge on entropy will help understanding the implementation of our **cost function**. The cost function in neural networks, and in machine learning in general, represents the error between the predicted values and the actual values. We seek to minimize the cost function. Usually the cost function is implemented as the **cross-entropy** between the predicted values and the actual values. For us, because we have 2 classes, we will be using **binary cross-entropy**. 

Equation


Equation 
 