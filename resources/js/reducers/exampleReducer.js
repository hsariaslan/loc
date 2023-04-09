import { createSlice } from '@reduxjs/toolkit';
import { TeamsService } from "../services";

const initialState = {
    value: 0,
    status: 'idle',
    teams: [],
    fixtures: [],
};


export const counterSlice = createSlice({
    name: 'champions_league',
    initialState,
    // The `reducers` field lets us define reducers and generate associated actions
    reducers: {
        increment: (state) => {
            // Redux Toolkit allows us to write "mutating" logic in reducers. It
            // doesn't actually mutate the state because it uses the Immer library,
            // which detects changes to a "draft state" and produces a brand new
            // immutable state based off those changes
            state.value += 1;
        },
        updateTeams: (state) => {
            // Redux Toolkit allows us to write "mutating" logic in reducers. It
            // doesn't actually mutate the state because it uses the Immer library,
            // which detects changes to a "draft state" and produces a brand new
            // immutable state based off those changes
            state.teams.push({name: "Manchester United"});
        },
        generateFixtures: (state) => {
            // Redux Toolkit allows us to write "mutating" logic in reducers. It
            // doesn't actually mutate the state because it uses the Immer library,
            // which detects changes to a "draft state" and produces a brand new
            // immutable state based off those changes
            state.teams.push({name: "Tottenham Hotspur"});
        },
        setTeams: (state, action) => {
            state.teams = action.payload;
        },
        setFixtures: (state, action) => {
            state.fixtures = action.payload;
        },
        decrement: (state) => {
            state.value -= 1;
        },
        // Use the PayloadAction type to declare the contents of `action.payload`
        incrementByAmount: (state, action) => {
            state.value += action.payload;
        },
    },
});

export const {
    increment,
    decrement,
    incrementByAmount,
    updateTeams,
    generateFixtures,
    setTeams,
    setFixtures
} = counterSlice.actions;

// The function below is called a selector and allows us to select a value from
// the state. Selectors can also be defined inline where they're used instead of
// in the slice file. For example: `useSelector((state: RootState) => state.counter.value)`
export const selectCount = (state) => state.counter.value;
export const selectTeams = (state) => state.teams;
export const selectFixtures = (state) => state.fixtures;

// We can also write thunks by hand, which may contain both sync and async logic.
// Here's an example of conditionally dispatching actions based on current state.
export const incrementIfOdd = (amount) => (dispatch, getState) => {
    const currentValue = selectCount(getState());
    if (currentValue % 2 === 1) {
        dispatch(incrementByAmount(amount));
    }
};

export default counterSlice.reducer;
