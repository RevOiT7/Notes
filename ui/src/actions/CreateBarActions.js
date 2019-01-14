import  {
    ACTION_RECEIVE_NAME_FOLDER,
    ACTION_OPEN_WINDOW_TO_CREATE,
    ACTION_CLOSED_WINDOW,
    ACTION_RECEIVE_CAPTION_NOTE
} from "../constants/constants";

export const receiveNameFolder = (e) => {
    return {
        type: ACTION_RECEIVE_NAME_FOLDER,
        payload: e.target.value
    }
};

export const receiveCaptionNote = (e) => {
    return {
        type: ACTION_RECEIVE_CAPTION_NOTE,
        payload: e.target.value
    }
};

export const closeWindow = (num) => {
    return {
        type: ACTION_CLOSED_WINDOW,
        payload: num
    }
};

export const openWindowToCreate = (num) => {
    return {
        type: ACTION_OPEN_WINDOW_TO_CREATE,
        payload: num
    }
};

