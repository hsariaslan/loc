import { createSlice } from '@reduxjs/toolkit';

const initialState = {
    value: 0,
    status: 'idle',
    teams: [],
    fixtures: [],
    matchesOfWeek: [],
    leagueTable: [],
    championshipPredictions: [],
};

export const counterSlice = createSlice({
    name: 'champions_league',
    initialState,
    reducers: {
        setTeams: (state, action) => {
            // todo: birden fazla state yapılabilir. 24:51
            state.teams = action.payload;
        },
        setFixtures: (state, action) => {
            state.fixtures = action.payload;
        },
        setMatchesOfWeek: (state, action) => {
            state.matchesOfWeek = action.payload;
        },
        updateMatchesOfWeek: (state, action) => {
            state.matchesOfWeek = [...action.payload, ...state.matchesOfWeek];
        },
        setLeagueTable: (state, action) => {
            state.leagueTable = action.payload;
        },
        setChampionshipPredictions: (state, action) => {
            state.championshipPredictions = action.payload;
        },
    },
});

export const {
    setTeams,
    setFixtures,
    setMatchesOfWeek,
    updateMatchesOfWeek,
    setLeagueTable,
    setChampionshipPredictions,
} = counterSlice.actions;

export const selectTeams = (state) => state.teams;
export const selectFixtures = (state) => state.fixtures;
export const selectMatchesOfWeek = (state) => state.matchesOfWeek;
export const selectLeagueTable = (state) => state.leagueTable;
export const selectChampionshipPredictions = (state) => state.championshipPredictions;

export default counterSlice.reducer;
