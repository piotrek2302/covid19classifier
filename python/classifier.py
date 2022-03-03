#!/usr/bin/env python
#

# import modules used here -- sys is a very standard one
import sys, argparse, logging
from keras.models import Model
from keras.layers import Dense, Dropout, GlobalAveragePooling2D
from keras.applications.resnet50 import ResNet50

import cv2
import tensorflow as tf;
import numpy as np
import json
def findMaxIndex(input_list):
    max_ind = 0
    max_el = -1000
    for i in range(len(input_list)):
        if(max_el<input_list[i]):
            max_ind=i
            max_el=input_list[i]
    return max_ind;


def classifiy(pred):
    val = findMaxIndex(pred);
    if(val == 0):
        return "Covid-19"
    elif(val == 1):
        return "Healthy"
    else:
        return "pneumonia"

# Gather our code in a main() function
def main(args, loglevel):
    logging.basicConfig(format="%(levelname)s: %(message)s", level=loglevel)
    BASE_PATH = args.base_path
    weights = BASE_PATH+'/python/'+"resnet50_weights_tf_dim_ordering_tf_kernels_notop.h5"
    PRETRAINED_MODEL=BASE_PATH+'/python/'+'with_full_data.dat'
    IMAGE_SIZE = (224,224)

    base_model = ResNet50(weights=BASE_PATH+'/python/'+"resnet50_weights_tf_dim_ordering_tf_kernels_notop.h5",include_top=False)
    # add a global spatial average pooling layer
    x = base_model.output
    x = GlobalAveragePooling2D()(x)
    # let's add a fully-connected layer
    x = Dense(64, activation='relu')(x)
    x = Dropout(0.3)(x)

    # and a logistic layer
    predictions = Dense(3, activation='softmax')(x)

    # this is the model we will train
    model = Model(inputs=base_model.input, outputs=predictions)

#    model.compile(loss='categorical_crossentropy',
#              optimizer=optimizer,
#              metrics=["accuracy"])


    model.load_weights(PRETRAINED_MODEL)

    test_img_file = args.IMAGE;
    image = tf.keras.preprocessing.image.load_img(test_img_file, grayscale=False, color_mode="rgb", target_size=IMAGE_SIZE, interpolation="nearest")
    input_arr = tf.keras.preprocessing.image.img_to_array(image)
    input_arr = np.array([input_arr])  # Convert single image to a batch.
    predictions = model.predict(input_arr)

    obj = {'raw':predictions[0].tolist(),'verdict':classifiy(predictions[0]),'covid':predictions[0][0].item(),'normal':predictions[0][1].item(),'pneumonia':predictions[0][2].item()}
    print(json.dumps(obj))

# Standard boilerplate to call the main() function to begin
# the program.
if __name__ == '__main__':
    parser = argparse.ArgumentParser(
                                    description = "Does a thing to some stuff.",
                                    epilog = "As an alternative to the commandline, params can be placed in a file, one per line, and specified on the commandline like '%(prog)s @params.conf'.",
                                    fromfile_prefix_chars = '@' )
    # TODO Specify your real parameters here.

    parser.add_argument(
                      "IMAGE",
                      help = "input image to classify",
                        )
    parser.add_argument("base_path",
                          help = "laravel's base path",
                           )
    parser.add_argument(
                      "-v",
                      "--verbose",
                      help="increase output verbosity",
                      action="store_true")
    args = parser.parse_args()

    # Setup logging
    if args.verbose:
        loglevel = logging.DEBUG
    else:
        loglevel = logging.INFO

    main(args, loglevel)