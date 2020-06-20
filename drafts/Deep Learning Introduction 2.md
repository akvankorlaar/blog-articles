[//]: # (TITLE: Deep Learning Introduction Part 2: Entropy and the Cost Function)
[//]: # (DATE: 2020-07-22)
[//]: # (TAGS: Artificial Intelligence, Deep Learning, Neural Networks)

This blog is part of an introductory series on deep learning.
For part 1 check: https://arentvankorlaar.nl/post/Deep%2offLearning%2offIntroduction%2offon.

In this second part we will first dive a bit (more than one bit actually) into entropy, and afterwards explain what the cost function of a neural network is.

# Entropy

**Entropy** is a measure with which the amount of information can be quantified. It is a cornerstone of information theory and very fundamentall to much of science in general. The basic intuition behind entropy is that events that are likely to occur do not contain alot of information, whereas events that are unlikely to occur contain alot of information. In this way,
entropy can be also seen as a measure of uncertainty: the higher the uncertainty, the higher the entropy. Entropy is commonly measured in bits. A bit can either be a 0 or 1. With more bits you can encode more information. A way to think about bits as containers of information, is to ask: 

"How many yes/no questions do I need to answer to know the exact state of an event?"


In order to explain this using an example, suppose you had a switch with 2 settings: on or off. At any time the switch can only be in one of these two settings. How many questions do you need to know the current setting of the switch? The answer is: exactly one. Why? You only need to ask on yes/no question: 'is the switch on?'. Now suppose we set the switch at a random setting, how much uncertainty is there of its position? 50% uncertainty,
because the setting can either be 'on', or 'off'.

The formula for entropy, when measured in bits, is given as:

![equation1](/images/blog2_equation1.gif) 

Now using this formula and filling in a probability of 50% yields:

```python
import math

- math.log2(0.5) = 1
```

As expected, we only needed 1 question, so the information content of something that has a 50% chance happening is 1 bit. Now suppose we had 3 of these switches. How many yes/no questions would you need now to know the exact setting of all the switches? Now you need 3 questions:

"Is the first switch on? Is the second switch on? Is the third switch on?"

Now the interesting thing is that if we only had one switch, we had 2 possible settings: on or off. However, now that we have 3 switches, our switches in total have 8 different possible settings:
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

So now, given that we have 8 possible states, setting all switches at a random
would give every setting a 1/8 chance of being the correct one. Calculating the number of bits using the above formula

```python
import math

-math.log2(1/8) = 3
```

Now the information content is 3 bits. So as you can see the entropy increases when the probability of an event decreases.

# Cost Function

This knowledge on entropy will help understanding the implementation of our **cost function** (Or **loss function** - sadly there is some disagreement on how to name this term). The cost function in neural networks, and in machine learning in general, represents the error between the predicted values of our neural network and the actual true values of our labeled data.

When training a neural network, we seek to minimize the cost function. Often the cost function is implemented as the **cross-entropy** between the predicted values of our neural network and the actual values of our labeled data. For us, because we have 2 classes, we will be using **binary cross-entropy**.

When our predictions equal the true values, the binary cross-entropy is 0. When this is not the case, the cross-entropy is > 0. The formula for binary cross-entropy is:

Equation


Equation 
 